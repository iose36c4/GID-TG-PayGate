#!/usr/bin/env node
/**
 * Kanban CLI — Autocontenido, sin dependencias externas
 * Uso: node kanban.js <comando> [opciones]
 */

const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

const BOARD_PATH = 'docu/kanban';
const TASKS_PATH = 'docu/kanban/tasks';
const TEMPLATES_PATH = 'docu/kanban/templates';

const COLUMNS = ['backlog', 'todo', 'in-progress', 'review', 'done'];
const DOMAINS = ['FUN', 'UX', 'UI', 'WEB', 'CSS', 'PUB', 'CLI', 'CRE', 'ADM', 'CRM', 'INS', 'DOC', 'KAN', 'TST-F', 'TST-P', 'TST-S'];
const PRIORITIES = ['P0', 'P1', 'P2', 'P3'];
const TYPES = ['task', 'bug', 'epic', 'milestone'];

// ==================== YAML Frontmatter Parser ====================
function parseFrontmatter(content) {
  const match = content.match(/^---\n([\s\S]*?)\n---\n([\s\S]*)$/);
  if (!match) throw new Error('Invalid frontmatter');
  
  const fm = {};
  const lines = match[1].split('\n');
  let currentKey = null;
  let isList = false;
  
  for (const line of lines) {
    const listMatch = line.match(/^(\s*)-\s+(.+)$/);
    if (listMatch) {
      const value = listMatch[2].trim().replace(/^["']|["']$/g, '');
      if (currentKey && isList) {
        fm[currentKey].push(value);
      }
      continue;
    }
    
    const kvMatch = line.match(/^(\s*)([^:]+):\s*(.*)$/);
    if (kvMatch) {
      currentKey = kvMatch[2].trim();
      const value = kvMatch[3].trim();
      
      if (value === '[]' || value === '') {
        fm[currentKey] = [];
        isList = true;
      } else if (value.startsWith('[') && value.endsWith(']')) {
        fm[currentKey] = value.slice(1, -1).split(',').map(v => v.trim().replace(/^["']|["']$/g, ''));
        isList = true;
      } else {
        fm[currentKey] = value.replace(/^["']|["']$/g, '');
        isList = false;
      }
    }
  }
  
  return { frontmatter: fm, body: match[2] };
}

function serializeFrontmatter(fm) {
  const lines = ['---'];
  for (const [key, value] of Object.entries(fm)) {
    if (Array.isArray(value)) {
      if (value.length === 0) {
        lines.push(`${key}: []`);
      } else {
        lines.push(`${key}:`);
        for (const item of value) {
          lines.push(`  - ${JSON.stringify(item)}`);
        }
      }
    } else if (typeof value === 'string') {
      lines.push(`${key}: ${JSON.stringify(value)}`);
    } else {
      lines.push(`${key}: ${JSON.stringify(String(value))}`);
    }
  }
  lines.push('---');
  return lines.join('\n') + '\n';
}

// ==================== File Operations ====================
function readTaskFile(id) {
  const filepath = path.join(TASKS_PATH, `${id}.md`);
  const content = fs.readFileSync(filepath, 'utf-8');
  const { frontmatter, body } = parseFrontmatter(content);
  return { id, frontmatter, body, filepath };
}

function writeTaskFile(task) {
  const content = serializeFrontmatter(task.frontmatter) + task.body;
  fs.writeFileSync(task.filepath, content, 'utf-8');
}

function listAllTasks() {
  const files = fs.readdirSync(TASKS_PATH);
  const tasks = [];
  for (const file of files) {
    if (file.endsWith('.md')) {
      const id = file.replace('.md', '');
      try {
        tasks.push(readTaskFile(id));
      } catch (e) { /* skip invalid */ }
    }
  }
  return tasks;
}

function readColumnFile(column) {
  const filepath = path.join(BOARD_PATH, `${column}.md`);
  const content = fs.readFileSync(filepath, 'utf-8');
  return parseFrontmatter(content);
}

function writeColumnFile(column, frontmatter, body) {
  const filepath = path.join(BOARD_PATH, `${column}.md`);
  const content = serializeFrontmatter(frontmatter) + body;
  fs.writeFileSync(filepath, content, 'utf-8');
}

function readTemplate(type) {
  const filepath = path.join(TEMPLATES_PATH, `${type}.md`);
  return fs.readFileSync(filepath, 'utf-8');
}

function getColumnFromTags(tags) {
  for (const tag of tags) {
    const col = tag.replace('kanban/', '');
    if (COLUMNS.includes(col)) return col;
  }
  return null;
}

function getDomainFromTags(tags) {
  for (const tag of tags) {
    const dom = tag.replace('domain/', '');
    if (DOMAINS.includes(dom)) return dom;
  }
  return null;
}

function generateId(domain, existing) {
  const nums = existing
    .filter(id => id.startsWith(`${domain}-`))
    .map(id => parseInt(id.split('-')[1], 10))
    .filter(n => !isNaN(n))
    .sort((a, b) => a - b);
  const next = nums.length > 0 ? Math.max(...nums) + 1 : 1;
  return `${domain}-${String(next).padStart(3, '0')}`;
}

function today() {
  return new Date().toISOString().split('T')[0];
}

// ==================== Commands ====================
function cmdRead(column) {
  if (column) {
    if (!COLUMNS.includes(column)) {
      console.error(`Columna inválida: ${column}`);
      process.exit(1);
    }
    const { frontmatter, body } = readColumnFile(column);
    const tasks = listAllTasks().filter(t => getColumnFromTags(t.frontmatter.tags) === column);
    console.log(`# ${column}`);
    console.log(`Total: ${tasks.length}`);
    for (const t of tasks) {
      console.log(`  - [[${t.id}]] ${t.frontmatter.status} | ${getDomainFromTags(t.frontmatter.tags)} | ${t.frontmatter.assignee} | ${t.frontmatter.updated}`);
    }
  } else {
    const tasks = listAllTasks();
    const byColumn = {};
    for (const col of COLUMNS) byColumn[col] = [];
    for (const task of tasks) {
      const col = getColumnFromTags(task.frontmatter.tags);
      if (col) byColumn[col].push(task);
    }
    for (const col of COLUMNS) {
      console.log(`## ${col} (${byColumn[col].length})`);
      for (const t of byColumn[col]) {
        console.log(`  - [[${t.id}]] ${t.frontmatter.status} | ${getDomainFromTags(t.frontmatter.tags)} | ${t.frontmatter.assignee}`);
      }
    }
  }
}

function cmdCreate(type, domain, title, opts) {
  if (!TYPES.includes(type)) { console.error(`Tipo inválido: ${type}`); process.exit(1); }
  if (!DOMAINS.includes(domain)) { console.error(`Dominio inválido: ${domain}`); process.exit(1); }
  
  const tasks = listAllTasks();
  const id = generateId(domain, tasks.map(t => t.id));
  
  const template = readTemplate(type);
  const { frontmatter: tmplFm, body: tmplBody } = parseFrontmatter(template);
  
  const now = today();
  const newFrontmatter = {
    tags: [
      `kanban/${opts.column || 'backlog'}`,
      `type/${type}`,
      `domain/${domain}`,
      `priority/${opts.priority || 'P2'}`
    ],
    parent: opts.parent || null,
    children: [],
    depends_on: opts.depends ? opts.depends.split(',').map(s => s.trim()) : [],
    blocks: [],
    status: (opts.column || 'backlog') === 'backlog' ? 'todo' : (opts.column || 'backlog'),
    assignee: opts.assignee || '@dev',
    created: now,
    updated: now
  };
  
  const newBody = tmplBody
    .replace(/\[\[TASK-ID\]\]/g, id)
    .replace(/Título Descriptivo de la Tarea/g, title)
    .replace(/Explicación detallada en español del qué y por qué./g, opts.description || 'Pendiente de descripción');
  
  const task = { id, frontmatter: newFrontmatter, body: newBody, filepath: path.join(TASKS_PATH, `${id}.md`) };
  writeTaskFile(task);
  
  const { frontmatter: colFm, body: colBody } = readColumnFile(opts.column || 'backlog');
  colFm.children = colFm.children || [];
  if (!colFm.children.includes(`[[${id}]]`)) {
    colFm.children.push(`[[${id}]]`);
    colFm.updated = now;
    writeColumnFile(opts.column || 'backlog', colFm, colBody);
  }
  
  if (opts.parent) {
    const parentId = opts.parent.replace(/[\[\]]/g, '');
    try {
      const pTask = readTaskFile(parentId);
      if (!pTask.frontmatter.children.includes(`[[${id}]]`)) {
        pTask.frontmatter.children.push(`[[${id}]]`);
        pTask.frontmatter.updated = now;
        writeTaskFile(pTask);
      }
    } catch { /* parent no existe */ }
  }
  
  console.log(`✅ Tarea ${id} creada en ${opts.column || 'backlog'}`);
}

function cmdMove(id, toColumn) {
  if (!COLUMNS.includes(toColumn)) { console.error(`Columna destino inválida: ${toColumn}`); process.exit(1); }
  
  const task = readTaskFile(id);
  const fromColumn = getColumnFromTags(task.frontmatter.tags);
  if (!fromColumn) { console.error(`Tarea no tiene columna válida`); process.exit(1); }
  if (fromColumn === toColumn) { console.log(`Ya está en ${toColumn}`); return; }
  
  const now = today();
  
  task.frontmatter.tags = task.frontmatter.tags.map(t => t.startsWith('kanban/') ? `kanban/${toColumn}` : t);
  task.frontmatter.status = toColumn === 'backlog' ? 'todo' : toColumn;
  task.frontmatter.updated = now;
  writeTaskFile(task);
  
  const { frontmatter: fromFm, body: fromBody } = readColumnFile(fromColumn);
  fromFm.children = (fromFm.children || []).filter(c => c !== `[[${id}]]`);
  fromFm.updated = now;
  writeColumnFile(fromColumn, fromFm, fromBody);
  
  const { frontmatter: toFm, body: toBody } = readColumnFile(toColumn);
  toFm.children = toFm.children || [];
  if (!toFm.children.includes(`[[${id}]]`)) {
    toFm.children.push(`[[${id}]]`);
  }
  toFm.updated = now;
  writeColumnFile(toColumn, toFm, toBody);
  
  console.log(`✅ Movido ${id}: ${fromColumn} → ${toColumn}`);
}

function cmdUpdate(id, opts) {
  const task = readTaskFile(id);
  const now = today();
  
  if (opts.set) {
    for (const pair of opts.set) {
      const [key, ...valParts] = pair.split('=');
      task.frontmatter[key] = valParts.join('=');
    }
  }
  task.frontmatter.updated = now;
  
  if (opts.append) {
    task.body += '\n\n' + opts.append;
  }
  
  writeTaskFile(task);
  console.log(`✅ Tarea ${id} actualizada`);
}

function cmdDelete(id, hard) {
  const task = readTaskFile(id);
  const col = getColumnFromTags(task.frontmatter.tags);
  
  if (!hard && col === 'done') {
    fs.unlinkSync(task.filepath);
    const { frontmatter: doneFm, body: doneBody } = readColumnFile('done');
    doneFm.children = (doneFm.children || []).filter(c => c !== `[[${id}]]`);
    writeColumnFile('done', doneFm, doneBody);
    console.log(`✅ Tarea ${id} archivada y eliminada`);
  } else if (!hard) {
    cmdMove(id, 'done');
    cmdDelete(id, true);
  } else {
    fs.unlinkSync(task.filepath);
    if (col) {
      const { frontmatter: colFm, body: colBody } = readColumnFile(col);
      colFm.children = (colFm.children || []).filter(c => c !== `[[${id}]]`);
      writeColumnFile(col, colFm, colBody);
    }
    console.log(`✅ Tarea ${id} eliminada permanentemente`);
  }
}

function cmdValidate() {
  const tasks = listAllTasks();
  const errors = [];
  const warnings = [];
  
  const ids = tasks.map(t => t.id);
  const dupIds = ids.filter((id, i) => ids.indexOf(id) !== i);
  if (dupIds.length) errors.push(`IDs duplicados: ${dupIds.join(', ')}`);
  
  for (const task of tasks) {
    const fm = task.frontmatter;
    if (!fm.tags || !Array.isArray(fm.tags)) errors.push(`${task.id}: tags inválido`);
    if (!fm.status) errors.push(`${task.id}: status faltante`);
    if (!fm.created || !fm.updated) errors.push(`${task.id}: fechas faltantes`);
    if (!DOMAINS.some(d => fm.tags?.includes(`domain/${d}`))) warnings.push(`${task.id}: sin domain`);
    if (!TYPES.some(t => fm.tags?.includes(`type/${t}`))) warnings.push(`${task.id}: sin type`);
    if (!PRIORITIES.some(p => fm.tags?.includes(`priority/${p}`))) warnings.push(`${task.id}: sin priority`);
  }
  
  for (const col of COLUMNS) {
    const { frontmatter: colFm } = readColumnFile(col);
    const colChildren = colFm.children || [];
    const tasksInCol = tasks.filter(t => getColumnFromTags(t.frontmatter.tags) === col);
    
    for (const child of colChildren) {
      const childId = child.replace(/[\[\]]/g, '');
      if (!tasksInCol.some(t => t.id === childId)) {
        warnings.push(`Columna ${col} referencia tarea inexistente: ${childId}`);
      }
    }
    for (const task of tasksInCol) {
      if (!colChildren.includes(`[[${task.id}]]`)) {
        warnings.push(`Tarea ${task.id} en ${col} pero no listada en columna`);
      }
    }
  }
  
  for (const task of tasks) {
    if (task.frontmatter.parent) {
      const pid = task.frontmatter.parent.replace(/[\[\]]/g, '');
      const parent = tasks.find(t => t.id === pid);
      if (parent && !parent.frontmatter.children.includes(`[[${task.id}]]`)) {
        warnings.push(`Parent ${pid} no tiene a ${task.id} en children`);
      }
    }
    for (const child of task.frontmatter.children || []) {
      const cid = child.replace(/[\[\]]/g, '');
      const childTask = tasks.find(t => t.id === cid);
      if (childTask && childTask.frontmatter.parent !== `[[${task.id}]]`) {
        warnings.push(`Child ${cid} no apunta a parent ${task.id}`);
      }
    }
  }
  
  for (const task of tasks) {
    for (const dep of task.frontmatter.depends_on || []) {
      const did = dep.replace(/[\[\]]/g, '');
      const depTask = tasks.find(t => t.id === did);
      if (depTask && !depTask.frontmatter.blocks.includes(`[[${task.id}]]`)) {
        warnings.push(`${did} no tiene a ${task.id} en blocks`);
      }
    }
  }
  
  if (errors.length) {
    console.error('❌ ERRORES:');
    for (const e of errors) console.error(`  - ${e}`);
  }
  if (warnings.length) {
    console.warn('⚠️ ADVERTENCIAS:');
    for (const w of warnings) console.warn(`  - ${w}`);
  }
  if (!errors.length && !warnings.length) {
    console.log('✅ Tablero válido sin inconsistencias');
  }
  console.log(`Total tareas: ${tasks.length}`);
  process.exit(errors.length > 0 ? 1 : 0);
}

function cmdMetricsCfd(days = 30) {
  const tasks = listAllTasks();
  const now = new Date();
  const dataPoints = [];
  
  for (let i = days - 1; i >= 0; i--) {
    const date = new Date(now);
    date.setDate(date.getDate() - i);
    const dateStr = date.toISOString().split('T')[0];
    const counts = { backlog: 0, todo: 0, 'in-progress': 0, review: 0, done: 0 };
    if (i === 0) {
      for (const task of tasks) {
        const col = getColumnFromTags(task.frontmatter.tags);
        if (col && counts[col] !== undefined) counts[col]++;
      }
    }
    dataPoints.push({ date: dateStr, ...counts, total: Object.values(counts).reduce((a, b) => a + b, 0) });
  }
  
  console.log('CFD Data Points:');
  console.log(JSON.stringify(dataPoints, null, 2));
  console.log('Nota: Para histórico real, integrarse con Git log');
}

function cmdMetricsLeadTime(ids = []) {
  const tasks = listAllTasks();
  const doneTasks = ids.length ? tasks.filter(t => ids.includes(t.id)) : tasks.filter(t => t.frontmatter.status === 'done');
  
  const results = doneTasks.map(task => {
    const created = new Date(task.frontmatter.created);
    const updated = new Date(task.frontmatter.updated);
    const leadTimeDays = (updated.getTime() - created.getTime()) / (1000 * 60 * 60 * 24);
    return { id: task.id, leadTimeDays: Math.round(leadTimeDays * 10) / 10, cycleTimeDays: Math.round(leadTimeDays * 10) / 10 };
  });
  
  const avgLead = results.reduce((s, r) => s + r.leadTimeDays, 0) / results.length || 0;
  const avgCycle = results.reduce((s, r) => s + r.cycleTimeDays, 0) / results.length || 0;
  
  console.log('Lead Time:');
  for (const r of results) console.log(`  ${r.id}: lead=${r.leadTimeDays}d cycle=${r.cycleTimeDays}d`);
  console.log(`Promedio: lead=${Math.round(avgLead * 10) / 10}d cycle=${Math.round(avgCycle * 10) / 10}d (${results.length} tareas)`);
}

function cmdMetricsWip(limitsJson = '{}') {
  const tasks = listAllTasks();
  let limits = {};
  try { limits = JSON.parse(limitsJson); } catch {}
  const defaultLimits = { 'in-progress': 2, review: 3 };
  limits = { ...defaultLimits, ...limits };
  
  const byColumn = {};
  for (const col of COLUMNS) byColumn[col] = [];
  for (const task of tasks) {
    const col = getColumnFromTags(task.frontmatter.tags);
    if (col) byColumn[col].push(task);
  }
  
  console.log('WIP Analysis:');
  let totalWIP = 0;
  for (const col of COLUMNS) {
    const colTasks = byColumn[col];
    const limit = limits[col];
    const aging = colTasks.map(t => {
      const updated = new Date(t.frontmatter.updated);
      const days = (Date.now() - updated.getTime()) / (1000 * 60 * 60 * 24);
      return { id: t.id, daysInColumn: Math.round(days * 10) / 10, assignee: t.frontmatter.assignee };
    }).sort((a, b) => b.daysInColumn - a.daysInColumn).slice(0, 5);
    
    if (col === 'in-progress' || col === 'review') totalWIP += colTasks.length;
    
    console.log(`  ${col}: ${colTasks.length}/${limit || '∞'} ${limit && colTasks.length > limit ? '⚠️ OVER' : ''}`);
    for (const a of aging) console.log(`    - ${a.id}: ${a.daysInColumn}d (${a.assignee})`);
  }
  console.log(`Total WIP (in-progress + review): ${totalWIP}`);
}

function cmdMetricsThroughput(weeks = 12) {
  const tasks = listAllTasks();
  const doneTasks = tasks.filter(t => t.frontmatter.status === 'done');
  
  const byWeek = {};
  const now = new Date();
  for (let i = weeks - 1; i >= 0; i--) {
    const weekStart = new Date(now);
    weekStart.setDate(weekStart.getDate() - (i + 1) * 7);
    const weekEnd = new Date(weekStart);
    weekEnd.setDate(weekEnd.getDate() + 6);
    const weekKey = `${weekStart.toISOString().split('T')[0]}_${weekEnd.toISOString().split('T')[0]}`;
    byWeek[weekKey] = 0;
  }
  
  for (const task of doneTasks) {
    const updated = new Date(task.frontmatter.updated);
    for (const [weekKey] of Object.entries(byWeek)) {
      const [startStr, endStr] = weekKey.split('_');
      const start = new Date(startStr);
      const end = new Date(endStr);
      if (updated >= start && updated <= end) {
        byWeek[weekKey]++;
        break;
      }
    }
  }
  
  const values = Object.values(byWeek);
  const avg = values.reduce((a, b) => a + b, 0) / values.length || 0;
  const trend = values.length >= 2 ? values[values.length - 1] - values[values.length - 2] : 0;
  
  console.log('Throughput Semanal:');
  for (const [week, count] of Object.entries(byWeek)) {
    console.log(`  ${week}: ${count}`);
  }
  console.log(`Promedio: ${Math.round(avg * 10) / 10}/semana, Trend: ${trend >= 0 ? '+' : ''}${trend}, Total: ${values.reduce((a, b) => a + b, 0)}`);
}

function cmdGitSyncCommits(since, until, apply) {
  const args = ['log', '--oneline', '--no-merges', '--pretty=format:%H|%s|%ad', '--date=short'];
  if (since) args.push(`--since=${since}`);
  if (until) args.push(`--until=${until}`);
  
  let output = '';
  try { output = execSync(`git ${args.join(' ')}`, { encoding: 'utf-8', cwd: process.cwd() }); } 
  catch { console.log('Sin commits'); return; }
  
  const commits = output.trim().split('\n').filter(Boolean);
  const tasks = listAllTasks();
  const taskMap = new Map(tasks.map(t => [t.id, t]));
  
  const patterns = {
    feat: /^(feat|feature|add)\(([A-Z]+-\d+)\):/i,
    fix: /^(fix|bugfix|hotfix)\(([A-Z]+-\d+)\):/i,
    move: /^(move|mv)\(([A-Z]+-\d+)→([a-z-]+)\):/i,
    review: /^(review|pr)\(([A-Z]+-\d+)\):/i,
    done: /^(done|complete|close)\(([A-Z]+-\d+)\):/i,
  };
  
  let applied = 0;
  for (const line of commits) {
    const parts = line.split('|');
    if (parts.length < 3) continue;
    const [hash, msg, date] = parts;
    
    for (const [action, pattern] of Object.entries(patterns)) {
      const match = msg.match(pattern);
      if (!match) continue;
      const taskId = match[2];
      const target = match[3];
      
      const task = taskMap.get(taskId);
      if (!task) continue;
      const currentCol = getColumnFromTags(task.frontmatter.tags);
      let canApply = false;
      
      if (action === 'feat' || action === 'fix') canApply = currentCol === 'backlog' || currentCol === 'todo';
      else if (action === 'move') canApply = target && COLUMNS.includes(target) && currentCol !== target;
      else if (action === 'review') canApply = currentCol === 'in-progress';
      else if (action === 'done') canApply = currentCol === 'review';
      
      if (!canApply) continue;
      
      if (apply) {
        try {
          if (action === 'move') cmdMove(taskId, target);
          else if (action === 'feat' || action === 'fix') cmdMove(taskId, 'in-progress');
          else if (action === 'review') cmdMove(taskId, 'review');
          else if (action === 'done') cmdMove(taskId, 'done');
          applied++;
        } catch { }
      }
    }
  }
  console.log(`${apply ? 'Aplicados' : 'Detectados'} ${applied} movimientos desde ${commits.length} commits`);
}

function cmdGitSyncPrs(apply) {
  try {
    const open = execSync('gh pr list --state=open --json number,title,headRefName --limit 50', { encoding: 'utf-8' });
    const merged = execSync('gh pr list --state=merged --json number,title,headRefName --limit 50', { encoding: 'utf-8' });
    
    const tasks = listAllTasks();
    const taskMap = new Map(tasks.map(t => [t.id, t]));
    let applied = 0;
    
    for (const pr of JSON.parse(open)) {
      const match = (pr.headRefName + ' ' + pr.title).match(/([A-Z]+-\d+)/);
      if (!match) continue;
      const taskId = match[1];
      const task = taskMap.get(taskId);
      if (!task) continue;
      if (getColumnFromTags(task.frontmatter.tags) === 'in-progress') {
        if (apply) { cmdMove(taskId, 'review'); applied++; }
      }
    }
    
    for (const pr of JSON.parse(merged)) {
      const match = (pr.headRefName + ' ' + pr.title).match(/([A-Z]+-\d+)/);
      if (!match) continue;
      const taskId = match[1];
      const task = taskMap.get(taskId);
      if (!task) continue;
      if (getColumnFromTags(task.frontmatter.tags) === 'review') {
        if (apply) { cmdMove(taskId, 'done'); applied++; }
      }
    }
    console.log(`${apply ? 'Sincronizados' : 'Detectados'} ${applied} PRs`);
  } catch (e) {
    console.log('gh CLI no disponible o sin auth');
  }
}

function cmdArchive(days = 7, apply) {
  const tasks = listAllTasks();
  const doneTasks = tasks.filter(t => t.frontmatter.status === 'done');
  const cutoff = Date.now() - days * 24 * 60 * 60 * 1000;
  const toArchive = doneTasks.filter(t => new Date(t.frontmatter.updated).getTime() < cutoff);
  
  if (!apply) {
    console.log(`Dry-run: ${toArchive.length} tareas a archivar (>${days}d en done)`);
    for (const t of toArchive) console.log(`  ${t.id} (${t.frontmatter.updated})`);
    return;
  }
  
  for (const task of toArchive) {
    const { frontmatter: doneFm, body: doneBody } = readColumnFile('done');
    const archiveEntry = `\n## Archived: ${task.id} (${task.frontmatter.updated})\n${task.body}\n---`;
    writeColumnFile('done', doneFm, doneBody + archiveEntry);
    fs.unlinkSync(task.filepath);
    doneFm.children = (doneFm.children || []).filter(c => c !== `[[${task.id}]]`);
    writeColumnFile('done', doneFm, doneBody + archiveEntry);
  }
  console.log(`✅ Archivadas ${toArchive.length} tareas`);
}

// ==================== Main ====================
function main() {
  const args = process.argv.slice(2);
  if (!args.length) { printHelp(); return; }
  
  const cmd = args[0];
  const rest = args.slice(1);
  
  switch (cmd) {
    case 'read': cmdRead(rest[0]); break;
    case 'create': {
      if (rest.length < 3) { console.error('Uso: create <type> <domain> --title "..."'); process.exit(1); }
      const type = rest[0], domain = rest[1];
      const opts = parseOpts(rest.slice(2));
      if (!opts.title) { console.error('--title requerido'); process.exit(1); }
      cmdCreate(type, domain, opts.title, opts);
      break;
    }
    case 'move': {
      if (rest.length < 2) { console.error('Uso: move <ID> <columna>'); process.exit(1); }
      cmdMove(rest[0], rest[1]);
      break;
    }
    case 'update': {
      if (rest.length < 1) { console.error('Uso: update <ID> [--set key=val] [--append "..."]'); process.exit(1); }
      const id = rest[0];
      const opts = parseOpts(rest.slice(1));
      cmdUpdate(id, opts);
      break;
    }
    case 'delete': {
      if (rest.length < 1) { console.error('Uso: delete <ID> [--hard]'); process.exit(1); }
      cmdDelete(rest[0], rest.includes('--hard'));
      break;
    }
    case 'validate': cmdValidate(); break;
    case 'metrics': {
      if (!rest.length) { console.error('Uso: metrics <cfd|lead-time|wip|throughput> [opciones]'); process.exit(1); }
      const sub = rest[0];
      const opts = parseOpts(rest.slice(1));
      if (sub === 'cfd') cmdMetricsCfd(opts.days ? parseInt(opts.days) : 30);
      else if (sub === 'lead-time') cmdMetricsLeadTime(opts.ids ? opts.ids.split(',') : []);
      else if (sub === 'wip') cmdMetricsWip(opts.limits || '{}');
      else if (sub === 'throughput') cmdMetricsThroughput(opts.weeks ? parseInt(opts.weeks) : 12);
      else { console.error('Métrica inválida'); process.exit(1); }
      break;
    }
    case 'git': {
      if (!rest.length) { console.error('Uso: git <sync-commits|sync-prs> [opciones]'); process.exit(1); }
      const sub = rest[0];
      const opts = parseOpts(rest.slice(1));
      if (sub === 'sync-commits') cmdGitSyncCommits(opts.since, opts.until, opts.apply === true);
      else if (sub === 'sync-prs') cmdGitSyncPrs(opts.apply === true);
      else { console.error('Subcomando git inválido'); process.exit(1); }
      break;
    }
    case 'archive': {
      const opts = parseOpts(rest);
      cmdArchive(opts.days ? parseInt(opts.days) : 7, opts.apply === true);
      break;
    }
    case 'help': printHelp(); break;
    default: console.error(`Comando desconocido: ${cmd}`); printHelp(); process.exit(1);
  }
}

function parseOpts(args) {
  const opts = {};
  for (let i = 0; i < args.length; i++) {
    const arg = args[i];
    if (arg.startsWith('--')) {
      const key = arg.slice(2);
      const next = args[i + 1];
      if (next && !next.startsWith('--')) {
        opts[key] = next;
        i++;
      } else {
        opts[key] = true;
      }
    } else if (arg.startsWith('-')) {
      // short opts not implemented
    }
  }
  return opts;
}

function printHelp() {
  console.log(`
Kanban CLI — TG-PayGate

Uso: node kanban.js <comando> [opciones]

Comandos:
  read [columna]                    Leer tablero o columna
  create <type> <domain> --title "T" [--priority P0] [--parent "[[x]]"] [--column backlog] [--assignee @dev] [--depends A,B] [--description "..."]
  move <ID> <columna>               Mover tarea
  update <ID> [--set campo=valor] [--append "texto"]  Actualizar
  delete <ID> [--hard]              Eliminar (archiva si en done)
  validate                          Validar consistencia tablero
  metrics <cfd|lead-time|wip|throughput> [opciones]
  git sync-commits [--since D] [--until D] [--apply]
  git sync-prs [--apply]
  archive [--days 7] [--apply]
  help                              Esta ayuda

Ejemplos:
  node kanban.js read
  node kanban.js create task FUN --title "Nueva feature" --priority P1
  node kanban.js move FUN-001 in-progress
  node kanban.js update FUN-001 --set assignee=@dev --append "Bloqueado por API"
  node kanban.js validate
  node kanban.js metrics cfd --days 30
  node kanban.js git sync-commits --since 2026-08-01 --apply
  node kanban.js archive --days 7 --apply
`);
}

main();