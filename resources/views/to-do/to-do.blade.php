<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sprint Board — SiSurat MVP</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
:root {
  --bg:       #0F1117;
  --surface:  #1A1D27;
  --surface2: #22263A;
  --border:   #2E3350;
  --border2:  #3D4266;
  --text:     #E8EAF6;
  --text2:    #8B91B8;
  --text3:    #5A6080;

  --blue:   #4F8EF7;
  --blue-d: #1A3A7A;
  --teal:   #2DD4BF;
  --teal-d: #0D4A44;
  --green:  #4ADE80;
  --green-d:#14532D;
  --amber:  #FBB847;
  --amber-d:#7A3D00;
  --red:    #F87171;
  --red-d:  #7F1D1D;
  --purple: #A78BFA;
  --purple-d:#3B0764;

  /* sprint colors */
  --s0: #4F8EF7; --s0d: #1A3A7A;
  --s1: #2DD4BF; --s1d: #0D4A44;
  --s2: #A78BFA; --s2d: #3B0764;
  --s3: #FBB847; --s3d: #7A3D00;
  --s4: #4ADE80; --s4d: #14532D;
}

* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
}

/* ── HEADER ── */
.header {
  background: linear-gradient(135deg, #0F1117 0%, #1A1D27 50%, #0F1525 100%);
  border-bottom: 1px solid var(--border);
  padding: 2rem 2rem 1.5rem;
  position: relative;
  overflow: hidden;
}
.header::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 300px; height: 300px;
  background: radial-gradient(circle, #4F8EF720 0%, transparent 65%);
  border-radius: 50%;
}
.header::after {
  content: '';
  position: absolute;
  bottom: -60px; left: 15%;
  width: 200px; height: 200px;
  background: radial-gradient(circle, #2DD4BF15 0%, transparent 65%);
  border-radius: 50%;
}
.header-inner { max-width: 1400px; margin: 0 auto; position: relative; z-index: 1; }
.header-top {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 1rem;
  flex-wrap: wrap;
}
.logo-box {
  width: 44px; height: 44px;
  background: linear-gradient(135deg, var(--blue), var(--teal));
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.header h1 {
  font-size: clamp(1.3rem, 3vw, 1.8rem);
  font-weight: 800;
  line-height: 1.2;
}
.header h1 span { color: var(--blue); }
.header-sub {
  font-size: 13px;
  color: var(--text2);
  margin-top: 2px;
}
.header-stats {
  display: flex;
  gap: 1rem;
  margin-top: 1.25rem;
  flex-wrap: wrap;
}
.stat-chip {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 7px 14px;
  font-size: 12px;
  color: var(--text2);
  display: flex;
  align-items: center;
  gap: 7px;
}
.stat-chip strong { color: var(--text); font-size: 14px; }

/* ── NAV ── */
.nav {
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  position: sticky;
  top: 0;
  z-index: 100;
}
.nav-inner {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  gap: 0;
  overflow-x: auto;
  scrollbar-width: none;
}
.nav-inner::-webkit-scrollbar { display: none; }
.nav-btn {
  padding: 14px 18px;
  background: transparent;
  border: none;
  border-bottom: 2px solid transparent;
  color: var(--text3);
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: all .2s;
  display: flex;
  align-items: center;
  gap: 7px;
}
.nav-btn:hover { color: var(--text); }
.nav-btn.on { color: var(--blue); border-bottom-color: var(--blue); }
.nav-btn.on.s0c { color: var(--s0); border-color: var(--s0); }
.nav-btn.on.s1c { color: var(--s1); border-color: var(--s1); }
.nav-btn.on.s2c { color: var(--s2); border-color: var(--s2); }
.nav-btn.on.s3c { color: var(--s3); border-color: var(--s3); }
.nav-btn.on.s4c { color: var(--s4); border-color: var(--s4); }
.nav-btn.on.tc  { color: var(--purple); border-color: var(--purple); }
.ndot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

/* ── MAIN ── */
.main { max-width: 1400px; margin: 0 auto; padding: 2rem; }
.panel { display: none; animation: fadeIn .2s ease; }
.panel.show { display: block; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

/* ── ROADMAP ── */
.roadmap {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 10px;
  margin-bottom: 2rem;
}
.rm-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 1rem;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  transition: all .2s;
}
.rm-card:hover { border-color: var(--border2); transform: translateY(-2px); }
.rm-card.active { border-width: 2px; }
.rm-accent {
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  border-radius: 12px 12px 0 0;
}
.rm-week {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--text3);
  margin-bottom: 6px;
  font-family: 'JetBrains Mono', monospace;
}
.rm-name {
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 4px;
}
.rm-goal {
  font-size: 11px;
  color: var(--text2);
  line-height: 1.4;
  margin-bottom: 10px;
}
.rm-tasks {
  display: flex;
  gap: 4px;
  flex-wrap: wrap;
}
.rm-task-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--border2);
}
.rm-task-dot.done { background: var(--green); }
.rm-count {
  font-size: 11px;
  color: var(--text3);
  font-family: 'JetBrains Mono', monospace;
  margin-top: 6px;
}

/* ── BOARD ── */
.board-wrap {
  overflow-x: auto;
  padding-bottom: 1rem;
}
.board {
  display: flex;
  gap: 12px;
  min-width: max-content;
}

/* ── LIST ── */
.list {
  width: 280px;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 12px;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  max-height: 78vh;
}
.list-head {
  padding: 12px 14px 10px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
}
.list-title {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .07em;
  display: flex;
  align-items: center;
  gap: 7px;
}
.list-count {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 20px;
  font-size: 11px;
  font-family: 'JetBrains Mono', monospace;
  color: var(--text2);
  padding: 1px 8px;
}
.list-body {
  padding: 10px;
  overflow-y: auto;
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.list-body::-webkit-scrollbar { width: 4px; }
.list-body::-webkit-scrollbar-track { background: transparent; }
.list-body::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 2px; }

/* ── CARD ── */
.card {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 12px;
  cursor: pointer;
  transition: all .15s;
  position: relative;
}
.card:hover { border-color: var(--border2); background: #282C45; }
.card.open { border-color: var(--blue); }
.card-accent {
  position: absolute;
  top: 0; left: 0; bottom: 0;
  width: 3px;
  border-radius: 10px 0 0 10px;
}
.card-id {
  font-family: 'JetBrains Mono', monospace;
  font-size: 9px;
  color: var(--text3);
  margin-bottom: 5px;
}
.card-title {
  font-size: 13px;
  font-weight: 600;
  line-height: 1.4;
  margin-bottom: 8px;
  padding-left: 6px;
}
.card-tags {
  display: flex;
  gap: 4px;
  flex-wrap: wrap;
  margin-bottom: 8px;
  padding-left: 6px;
}
.tag {
  font-size: 10px;
  padding: 2px 7px;
  border-radius: 20px;
  font-weight: 600;
}
.tag-be { background: #1A3A7A; color: #93C5FD; }
.tag-fe { background: #0D4A44; color: #5EEAD4; }
.tag-db { background: #3B0764; color: #C4B5FD; }
.tag-cfg{ background: #292524; color: #A8A29E; }
.tag-tst{ background: #7A3D00; color: #FDE68A; }
.tag-doc{ background: #1E3A5F; color: #93C5FD; }
.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-left: 6px;
}
.card-est {
  font-size: 10px;
  color: var(--text3);
  font-family: 'JetBrains Mono', monospace;
  display: flex;
  align-items: center;
  gap: 4px;
}
.card-pri {
  font-size: 9px;
  font-weight: 700;
  padding: 2px 6px;
  border-radius: 4px;
  text-transform: uppercase;
  letter-spacing: .04em;
}
.pri-high   { background: #7F1D1D; color: #FCA5A5; }
.pri-med    { background: #7A3D00; color: #FDE68A; }
.pri-low    { background: #14532D; color: #86EFAC; }
.card-check {
  font-size: 10px;
  color: var(--text3);
  font-family: 'JetBrains Mono', monospace;
}

/* ── MODAL ── */
.modal-bg {
  display: none;
  position: fixed;
  inset: 0;
  background: #00000090;
  z-index: 200;
  align-items: center;
  justify-content: center;
  padding: 1rem;
}
.modal-bg.open { display: flex; }
.modal {
  background: var(--surface);
  border: 1px solid var(--border2);
  border-radius: 14px;
  width: 100%;
  max-width: 600px;
  max-height: 85vh;
  overflow-y: auto;
  animation: modalIn .2s ease;
}
@keyframes modalIn {
  from { opacity: 0; transform: scale(.96) translateY(10px); }
  to { opacity: 1; transform: scale(1) translateY(0); }
}
.modal-head {
  padding: 18px 20px 14px;
  border-bottom: 1px solid var(--border);
  display: flex;
  gap: 10px;
  align-items: flex-start;
}
.modal-badge {
  font-family: 'JetBrains Mono', monospace;
  font-size: 10px;
  padding: 3px 8px;
  border-radius: 6px;
  font-weight: 500;
  flex-shrink: 0;
  margin-top: 2px;
}
.modal-title {
  font-size: 16px;
  font-weight: 700;
  flex: 1;
  line-height: 1.3;
}
.modal-close {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 8px;
  color: var(--text2);
  width: 30px; height: 30px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  font-size: 16px;
  flex-shrink: 0;
}
.modal-close:hover { background: var(--border); }
.modal-body { padding: 18px 20px; }
.modal-section {
  margin-bottom: 18px;
}
.modal-section:last-child { margin-bottom: 0; }
.ms-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--text3);
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.ms-label::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--border);
}
.ms-desc {
  font-size: 13px;
  color: var(--text2);
  line-height: 1.6;
}
.ms-story {
  font-size: 13px;
  color: var(--text2);
  background: var(--surface2);
  border-left: 3px solid var(--blue);
  padding: 10px 12px;
  border-radius: 0 8px 8px 0;
  line-height: 1.6;
}
.checklist {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.ci {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  font-size: 13px;
  color: var(--text2);
  line-height: 1.4;
  cursor: pointer;
  user-select: none;
}
.cbox {
  width: 16px; height: 16px;
  border: 1.5px solid var(--border2);
  border-radius: 4px;
  flex-shrink: 0;
  margin-top: 1px;
  display: flex; align-items: center; justify-content: center;
  transition: all .15s;
}
.cbox.done {
  background: var(--green);
  border-color: var(--green);
}
.cbox.done::after {
  content: '✓';
  font-size: 10px;
  color: var(--bg);
  font-weight: 700;
}
.ci.done span { text-decoration: line-through; color: var(--text3); }
.meta-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
}
.meta-chip {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 8px 12px;
}
.meta-chip .ml { font-size: 10px; color: var(--text3); margin-bottom: 2px; text-transform: uppercase; letter-spacing: .05em; }
.meta-chip .mv { font-size: 13px; font-weight: 600; color: var(--text); }
.dep-tag {
  display: inline-block;
  font-family: 'JetBrains Mono', monospace;
  font-size: 10px;
  padding: 2px 8px;
  border-radius: 6px;
  background: var(--surface2);
  border: 1px solid var(--border2);
  color: var(--text2);
  margin: 2px;
}

/* ── TRELLO GUIDE ── */
.tg-section { margin-bottom: 2rem; }
.tg-title {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 8px;
}
.tg-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 10px;
  margin-bottom: 1rem;
}
.tg-list-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 12px 14px;
}
.tg-list-name {
  font-size: 13px;
  font-weight: 700;
  margin-bottom: 6px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.tg-list-desc { font-size: 12px; color: var(--text2); line-height: 1.5; }
.label-grid {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}
.label-chip {
  padding: 5px 12px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
}
.dod-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.dod-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 14px;
}
.dod-sprint {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: var(--text3);
  margin-bottom: 10px;
}
.dod-item {
  display: flex;
  gap: 8px;
  font-size: 12px;
  color: var(--text2);
  margin-bottom: 6px;
  line-height: 1.4;
  cursor: pointer;
}
.dod-box {
  width: 14px; height: 14px;
  border: 1.5px solid var(--border2);
  border-radius: 3px;
  flex-shrink: 0;
  margin-top: 1px;
  display: flex; align-items: center; justify-content: center;
}
.dod-box.done { background: var(--teal); border-color: var(--teal); }
.dod-box.done::after { content: '✓'; font-size: 9px; color: var(--bg); font-weight: 700; }

/* responsive */
@media(max-width:600px) {
  .header { padding: 1.5rem 1rem 1rem; }
  .main { padding: 1rem; }
  .meta-row { grid-template-columns: 1fr; }
  .dod-grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
  <div class="header-inner">
    <div class="header-top">
      <div class="logo-box">✉</div>
      <div>
        <h1>Sprint Board — <span>SiSurat</span></h1>
        <div class="header-sub">Universitas Alifah · MVP Surat Masuk · Laravel 13 + MySQL</div>
      </div>
    </div>
    <div class="header-stats">
      <div class="stat-chip"><strong>5</strong> Sprint</div>
      <div class="stat-chip"><strong>38</strong> Total Task</div>
      <div class="stat-chip"><strong>~10</strong> Minggu</div>
      <div class="stat-chip"><strong>3</strong> Role</div>
      <div class="stat-chip" style="color:var(--amber)">MVP Fokus Surat Masuk</div>
    </div>
  </div>
</div>

<!-- NAV -->
<div class="nav">
  <div class="nav-inner">
    <button class="nav-btn on s0c" onclick="showPanel('roadmap',this)">
      <span class="ndot" style="background:var(--s0)"></span> Roadmap
    </button>
    <button class="nav-btn s0c" onclick="showPanel('s0',this)">
      <span class="ndot" style="background:var(--s0)"></span> Pra-Sprint
    </button>
    <button class="nav-btn s1c" onclick="showPanel('s1',this)">
      <span class="ndot" style="background:var(--s1)"></span> Sprint 1
    </button>
    <button class="nav-btn s2c" onclick="showPanel('s2',this)">
      <span class="ndot" style="background:var(--s2)"></span> Sprint 2
    </button>
    <button class="nav-btn s3c" onclick="showPanel('s3',this)">
      <span class="ndot" style="background:var(--s3)"></span> Sprint 3
    </button>
    <button class="nav-btn s4c" onclick="showPanel('s4',this)">
      <span class="ndot" style="background:var(--s4)"></span> Sprint 4
    </button>
    <button class="nav-btn tc" onclick="showPanel('trello',this)">
      <span class="ndot" style="background:var(--purple)"></span> Panduan Trello
    </button>
  </div>
</div>

<div class="main">

<!-- ══ ROADMAP ═══════════════════════════════════════════ -->
<div id="p-roadmap" class="panel show">
  <div style="margin-bottom:1.5rem">
    <div style="font-size:18px;font-weight:800;margin-bottom:4px">Sprint Roadmap MVP SiSurat</div>
    <div style="font-size:13px;color:var(--text2)">Klik salah satu sprint di bawah untuk melihat board Trello dan task breakdown-nya.</div>
  </div>

  <div class="roadmap">
    <div class="rm-card active" style="border-color:var(--s0)" onclick="showPanel('s0',document.querySelectorAll('.nav-btn')[1])">
      <div class="rm-accent" style="background:var(--s0)"></div>
      <div class="rm-week">Minggu 1–2</div>
      <div class="rm-name" style="color:var(--s0)">Pra-Sprint</div>
      <div class="rm-goal">Setup project, ERD, install semua dependency, database siap, login & role aktif</div>
      <div class="rm-count">8 task · ~14 jam</div>
    </div>
    <div class="rm-card" style="border-color:var(--s1)" onclick="showPanel('s1',document.querySelectorAll('.nav-btn')[2])">
      <div class="rm-accent" style="background:var(--s1)"></div>
      <div class="rm-week">Minggu 3–4</div>
      <div class="rm-name" style="color:var(--s1)">Sprint 1</div>
      <div class="rm-goal">Admin CRUD surat masuk + upload file + daftar surat</div>
      <div class="rm-count">9 task · ~16 jam</div>
    </div>
    <div class="rm-card" style="border-color:var(--s2)" onclick="showPanel('s2',document.querySelectorAll('.nav-btn')[3])">
      <div class="rm-accent" style="background:var(--s2)"></div>
      <div class="rm-week">Minggu 5–6</div>
      <div class="rm-name" style="color:var(--s2)">Sprint 2</div>
      <div class="rm-goal">Alur review Wakil Rektor — teruskan & kembalikan dengan catatan</div>
      <div class="rm-count">7 task · ~12 jam</div>
    </div>
    <div class="rm-card" style="border-color:var(--s3)" onclick="showPanel('s3',document.querySelectorAll('.nav-btn')[4])">
      <div class="rm-accent" style="background:var(--s3)"></div>
      <div class="rm-week">Minggu 7–8</div>
      <div class="rm-name" style="color:var(--s3)">Sprint 3</div>
      <div class="rm-goal">Alur Rektor approve + disposisi sederhana ke bagian terkait</div>
      <div class="rm-count">7 task · ~12 jam</div>
    </div>
    <div class="rm-card" style="border-color:var(--s4)" onclick="showPanel('s4',document.querySelectorAll('.nav-btn')[5])">
      <div class="rm-accent" style="background:var(--s4)"></div>
      <div class="rm-week">Minggu 9–10</div>
      <div class="rm-name" style="color:var(--s4)">Sprint 4</div>
      <div class="rm-goal">Dashboard sederhana + polish UI + testing + persiapan UAT</div>
      <div class="rm-count">7 task · ~12 jam</div>
    </div>
  </div>

  <!-- alur visual -->
  <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1.5rem">
    <div style="font-size:13px;font-weight:700;margin-bottom:14px;color:var(--text2);text-transform:uppercase;letter-spacing:.06em">Alur workflow yang dibangun</div>
    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
      <div style="background:#1A3A7A;border:1px solid var(--s0);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#93C5FD">Admin<br><span style="font-size:11px;font-weight:400;color:#60A5FA">Input surat</span></div>
      <div style="color:var(--text3);font-size:18px">→</div>
      <div style="background:#0D4A44;border:1px solid var(--s1);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#5EEAD4">Wakil Rektor<br><span style="font-size:11px;font-weight:400;color:#2DD4BF">Review & teruskan</span></div>
      <div style="color:var(--text3);font-size:18px">→</div>
      <div style="background:#3B0764;border:1px solid var(--s2);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#C4B5FD">Rektor<br><span style="font-size:11px;font-weight:400;color:#A78BFA">Approve final</span></div>
      <div style="color:var(--text3);font-size:18px">→</div>
      <div style="background:var(--green-d);border:1px solid var(--green);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#86EFAC">Selesai ✓<br><span style="font-size:11px;font-weight:400">Status final</span></div>
    </div>
    <div style="margin-top:10px;display:flex;align-items:center;gap:8px;flex-wrap:wrap">
      <div style="background:#0D4A44;border:1px solid var(--s1);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#5EEAD4">Wakil Rektor</div>
      <div style="color:var(--red);font-size:18px">→</div>
      <div style="background:var(--red-d);border:1px solid var(--red);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#FCA5A5">Dikembalikan<br><span style="font-size:11px;font-weight:400">+ catatan wajib</span></div>
      <div style="color:var(--text3);font-size:18px">→</div>
      <div style="background:#1A3A7A;border:1px solid var(--s0);border-radius:8px;padding:8px 14px;font-size:13px;font-weight:600;color:#93C5FD">Admin revisi</div>
    </div>
  </div>

  <!-- status chips -->
  <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:1.5rem">
    <div style="font-size:13px;font-weight:700;margin-bottom:14px;color:var(--text2);text-transform:uppercase;letter-spacing:.06em">Status surat_masuk</div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
      <div style="background:#1E293B;border:1px solid #475569;border-radius:20px;padding:5px 14px;font-size:12px;font-family:'JetBrains Mono',monospace;color:#94A3B8">draft</div>
      <div style="color:var(--text3)">→</div>
      <div style="background:#7A3D00;border:1px solid var(--amber);border-radius:20px;padding:5px 14px;font-size:12px;font-family:'JetBrains Mono',monospace;color:var(--amber)">menunggu_warek</div>
      <div style="color:var(--text3)">→</div>
      <div style="background:#1A3A7A;border:1px solid var(--blue);border-radius:20px;padding:5px 14px;font-size:12px;font-family:'JetBrains Mono',monospace;color:var(--blue)">menunggu_rektor</div>
      <div style="color:var(--text3)">→</div>
      <div style="background:var(--green-d);border:1px solid var(--green);border-radius:20px;padding:5px 14px;font-size:12px;font-family:'JetBrains Mono',monospace;color:var(--green)">selesai</div>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:8px">
      <div style="background:var(--red-d);border:1px solid var(--red);border-radius:20px;padding:5px 14px;font-size:12px;font-family:'JetBrains Mono',monospace;color:var(--red)">dikembalikan</div>
      <div style="font-size:12px;color:var(--text3);padding:5px 0;line-height:1.4">← bisa terjadi dari menunggu_warek atau menunggu_rektor</div>
    </div>
  </div>
</div>

<!-- ══ PRA-SPRINT ═══════════════════════════════════════ -->
<div id="p-s0" class="panel">
  <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
    <div style="background:var(--s0d);border:1px solid var(--s0);border-radius:8px;padding:4px 12px;font-size:12px;font-weight:700;color:var(--s0)">Pra-Sprint</div>
    <div style="font-size:18px;font-weight:800">Setup & Fondasi</div>
  </div>
  <div style="font-size:13px;color:var(--text2);margin-bottom:1.5rem">Minggu 1–2 · Goal: Laravel jalan di localhost, login & role aktif, semua tabel siap, seeder berhasil</div>

  <div class="board-wrap">
    <div class="board" id="board-s0"></div>
  </div>
</div>

<!-- ══ SPRINT 1 ══════════════════════════════════════════ -->
<div id="p-s1" class="panel">
  <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
    <div style="background:var(--s1d);border:1px solid var(--s1);border-radius:8px;padding:4px 12px;font-size:12px;font-weight:700;color:var(--s1)">Sprint 1</div>
    <div style="font-size:18px;font-weight:800">CRUD Surat Masuk</div>
  </div>
  <div style="font-size:13px;color:var(--text2);margin-bottom:1.5rem">Minggu 3–4 · Goal: Admin bisa input, upload file, lihat daftar & detail surat masuk</div>
  <div class="board-wrap">
    <div class="board" id="board-s1"></div>
  </div>
</div>

<!-- ══ SPRINT 2 ══════════════════════════════════════════ -->
<div id="p-s2" class="panel">
  <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
    <div style="background:var(--s2d);border:1px solid var(--s2);border-radius:8px;padding:4px 12px;font-size:12px;font-weight:700;color:var(--s2)">Sprint 2</div>
    <div style="font-size:18px;font-weight:800">Review Wakil Rektor</div>
  </div>
  <div style="font-size:13px;color:var(--text2);margin-bottom:1.5rem">Minggu 5–6 · Goal: Warek bisa teruskan atau kembalikan surat dengan catatan</div>
  <div class="board-wrap">
    <div class="board" id="board-s2"></div>
  </div>
</div>

<!-- ══ SPRINT 3 ══════════════════════════════════════════ -->
<div id="p-s3" class="panel">
  <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
    <div style="background:var(--s3d);border:1px solid var(--s3);border-radius:8px;padding:4px 12px;font-size:12px;font-weight:700;color:var(--s3)">Sprint 3</div>
    <div style="font-size:18px;font-weight:800">Approve Rektor + Disposisi</div>
  </div>
  <div style="font-size:13px;color:var(--text2);margin-bottom:1.5rem">Minggu 7–8 · Goal: Rektor approve surat, disposisi ke bagian terkait, alur end-to-end selesai</div>
  <div class="board-wrap">
    <div class="board" id="board-s3"></div>
  </div>
</div>

<!-- ══ SPRINT 4 ══════════════════════════════════════════ -->
<div id="p-s4" class="panel">
  <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
    <div style="background:var(--s4d);border:1px solid var(--s4);border-radius:8px;padding:4px 12px;font-size:12px;font-weight:700;color:var(--s4)">Sprint 4</div>
    <div style="font-size:18px;font-weight:800">Dashboard & Polish</div>
  </div>
  <div style="font-size:13px;color:var(--text2);margin-bottom:1.5rem">Minggu 9–10 · Goal: Dashboard sederhana, UI konsisten, testing manual, siap UAT klien</div>
  <div class="board-wrap">
    <div class="board" id="board-s4"></div>
  </div>
</div>

<!-- ══ PANDUAN TRELLO ════════════════════════════════════ -->
<div id="p-trello" class="panel">
  <div style="font-size:18px;font-weight:800;margin-bottom:4px">Panduan Setup Trello</div>
  <div style="font-size:13px;color:var(--text2);margin-bottom:1.5rem">Cara membuat board Trello yang persis seperti sprint board ini.</div>

  <div class="tg-section">
    <div class="tg-title">1. Buat workspace & board</div>
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:1rem;font-size:13px;color:var(--text2);line-height:1.8">
      • Buat <strong style="color:var(--text)">Workspace</strong> baru → nama: <code style="font-family:'JetBrains Mono',monospace;background:var(--surface2);padding:1px 6px;border-radius:4px">SiSurat - Universitas Alifah</code><br>
      • Buat <strong style="color:var(--text)">5 Board</strong> terpisah untuk tiap sprint:<br>
      &nbsp;&nbsp;&nbsp;→ <code style="font-family:'JetBrains Mono',monospace;background:#1A3A7A;padding:1px 6px;border-radius:4px;color:#93C5FD">SiSurat — Pra-Sprint</code><br>
      &nbsp;&nbsp;&nbsp;→ <code style="font-family:'JetBrains Mono',monospace;background:#0D4A44;padding:1px 6px;border-radius:4px;color:#5EEAD4">SiSurat — Sprint 1</code><br>
      &nbsp;&nbsp;&nbsp;→ <code style="font-family:'JetBrains Mono',monospace;background:#3B0764;padding:1px 6px;border-radius:4px;color:#C4B5FD">SiSurat — Sprint 2</code><br>
      &nbsp;&nbsp;&nbsp;→ <code style="font-family:'JetBrains Mono',monospace;background:#7A3D00;padding:1px 6px;border-radius:4px;color:#FDE68A">SiSurat — Sprint 3</code><br>
      &nbsp;&nbsp;&nbsp;→ <code style="font-family:'JetBrains Mono',monospace;background:#14532D;padding:1px 6px;border-radius:4px;color:#86EFAC">SiSurat — Sprint 4</code>
    </div>
  </div>

  <div class="tg-section">
    <div class="tg-title">2. Buat 6 List di setiap Board</div>
    <div class="tg-grid">
      <div class="tg-list-card"><div class="tg-list-name">📋 Backlog</div><div class="tg-list-desc">Semua task sprint yang belum mulai dikerjakan</div></div>
      <div class="tg-list-card"><div class="tg-list-name">📌 To Do</div><div class="tg-list-desc">Task yang siap dikerjakan minggu ini</div></div>
      <div class="tg-list-card"><div class="tg-list-name">🔄 In Progress</div><div class="tg-list-desc">Sedang dikerjakan sekarang — max 2-3 kartu sekaligus</div></div>
      <div class="tg-list-card"><div class="tg-list-name">👀 Review</div><div class="tg-list-desc">Selesai dikode, menunggu dicek ulang atau test</div></div>
      <div class="tg-list-card"><div class="tg-list-name">🧪 Testing</div><div class="tg-list-desc">Sedang ditest manual — cek semua checklist</div></div>
      <div class="tg-list-card"><div class="tg-list-name">✅ Done</div><div class="tg-list-desc">Selesai dan semua checklist centang</div></div>
    </div>
  </div>

  <div class="tg-section">
    <div class="tg-title">3. Buat Label warna</div>
    <div class="label-grid">
      <div class="label-chip tag-be">🔵 Backend</div>
      <div class="label-chip tag-fe">🟢 Frontend/UI</div>
      <div class="label-chip tag-db">🟣 Database</div>
      <div class="label-chip tag-cfg">⚫ Config/Setup</div>
      <div class="label-chip tag-tst">🟡 Testing</div>
      <div class="label-chip tag-doc">🔷 Dokumentasi</div>
      <div class="label-chip" style="background:#7F1D1D;color:#FCA5A5">🔴 High Priority</div>
      <div class="label-chip" style="background:#7A3D00;color:#FDE68A">🟠 Med Priority</div>
      <div class="label-chip" style="background:#14532D;color:#86EFAC">🟢 Low Priority</div>
    </div>
  </div>

  <div class="tg-section">
    <div class="tg-title">4. Template kartu Trello (isi ke setiap kartu)</div>
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:1rem">
      <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text2);line-height:2">
        <span style="color:var(--blue)">Judul kartu:</span> [S0-01] Setup Laravel 13<br>
        <span style="color:var(--blue)">Deskripsi:</span> Install Laravel 13 dan konfigurasi semua file awal yang dibutuhkan<br><br>
        <span style="color:var(--blue)">User Story:</span><br>
        Sebagai developer, saya ingin project Laravel terkonfigurasi dengan benar agar bisa mulai development<br><br>
        <span style="color:var(--blue)">Checklist:</span><br>
        ☐ composer create-project laravel/laravel sisurat<br>
        ☐ Konfigurasi .env (DB_NAME, APP_NAME, APP_URL)<br>
        ☐ Test php artisan serve jalan tanpa error<br><br>
        <span style="color:var(--blue)">Estimasi:</span> 1 jam<br>
        <span style="color:var(--blue)">Label:</span> Config/Setup<br>
        <span class="dep-tag">Dependency: –</span>
      </div>
    </div>
  </div>

  <div class="tg-section">
    <div class="tg-title">5. Definition of Done per Sprint</div>
    <div class="dod-grid">
      <div class="dod-card">
        <div class="dod-sprint" style="color:var(--s0)">Pra-Sprint selesai jika...</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>php artisan serve jalan tanpa error</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Login dengan 3 akun role berbeda berhasil</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Semua tabel ada di database (php artisan migrate)</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Seeder berhasil (php artisan db:seed)</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Akses route role lain ditolak (403)</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Sidebar berbeda tiap role</div>
      </div>
      <div class="dod-card">
        <div class="dod-sprint" style="color:var(--s1)">Sprint 1 selesai jika...</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Admin bisa input + simpan surat masuk</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>File PDF berhasil diupload dan tersimpan</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Daftar surat tampil dengan data yang benar</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Halaman detail surat masuk lengkap</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Status badge tampil sesuai status</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Admin bisa ajukan ke Warek (ubah status)</div>
      </div>
      <div class="dod-card">
        <div class="dod-sprint" style="color:var(--s2)">Sprint 2 selesai jika...</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Warek hanya lihat surat status menunggu_warek</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Warek bisa teruskan ke Rektor</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Warek bisa kembalikan + catatan wajib diisi</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Status surat berubah otomatis</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Catatan Warek tampil di detail surat</div>
      </div>
      <div class="dod-card">
        <div class="dod-sprint" style="color:var(--s3)">Sprint 3 selesai jika...</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Rektor hanya lihat surat menunggu_rektor</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Rektor bisa approve → status selesai</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Rektor bisa disposisi ke bagian terkait</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Alur penuh end-to-end jalan tanpa error</div>
        <div class="dod-item" onclick="tgDod(this)"><div class="dod-box"></div>Timeline status tampil di halaman detail</div>
      </div>
    </div>
  </div>
</div>

</div><!-- /main -->

<!-- MODAL -->
<div class="modal-bg" id="modal" onclick="closeModal(event)">
  <div class="modal" id="modal-inner">
    <div class="modal-head">
      <span class="modal-badge" id="m-badge"></span>
      <div class="modal-title" id="m-title"></div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body" id="m-body"></div>
  </div>
</div>

<script>
// ══ DATA ══════════════════════════════════════════════════════════

const sprintColors = {
  s0: { accent: '#4F8EF7', bg: '#1A3A7A', text: '#93C5FD' },
  s1: { accent: '#2DD4BF', bg: '#0D4A44', text: '#5EEAD4' },
  s2: { accent: '#A78BFA', bg: '#3B0764', text: '#C4B5FD' },
  s3: { accent: '#FBB847', bg: '#7A3D00', text: '#FDE68A' },
  s4: { accent: '#4ADE80', bg: '#14532D', text: '#86EFAC' },
};

const listDefs = [
  { id: 'backlog',     label: '📋 Backlog',     dot: '#5A6080' },
  { id: 'todo',        label: '📌 To Do',        dot: '#4F8EF7' },
  { id: 'inprogress',  label: '🔄 In Progress',  dot: '#FBB847' },
  { id: 'review',      label: '👀 Review',       dot: '#A78BFA' },
  { id: 'testing',     label: '🧪 Testing',      dot: '#2DD4BF' },
  { id: 'done',        label: '✅ Done',          dot: '#4ADE80' },
];

// ── TASKS DATA ────────────────────────────────────────────────────

const tasks = {
  s0: [
    {
      id:'S0-01', list:'backlog', title:'Install Laravel 13 & konfigurasi .env',
      tags:['cfg'], pri:'high', est:'1 jam',
      story:'Sebagai developer, saya ingin project Laravel terkonfigurasi agar bisa mulai development.',
      desc:'Install fresh Laravel 13, konfigurasi .env untuk koneksi database MySQL, dan pastikan artisan serve berjalan.',
      checks:['composer create-project laravel/laravel sisurat','Konfigurasi .env: DB_NAME=sisurat, APP_NAME=SiSurat','Buat database MySQL: CREATE DATABASE sisurat','php artisan key:generate','Test: php artisan serve → buka localhost:8000'],
      deps:[]
    },
    {
      id:'S0-02', list:'backlog', title:'Install & setup Laravel Breeze (Auth)',
      tags:['cfg','be'], pri:'high', est:'1 jam',
      story:'Sebagai developer, saya ingin sistem autentikasi siap pakai agar user bisa login.',
      desc:'Install Breeze dengan template Blade, jalankan migration auth, setup frontend.',
      checks:['composer require laravel/breeze --dev','php artisan breeze:install blade','npm install && npm run dev','php artisan migrate','Test login/logout berfungsi di browser'],
      deps:['S0-01']
    },
    {
      id:'S0-03', list:'backlog', title:'Install Spatie Laravel Permission',
      tags:['cfg','be'], pri:'high', est:'1 jam',
      story:'Sebagai developer, saya ingin sistem role & permission agar setiap pengguna punya akses yang berbeda.',
      desc:'Install Spatie, publish config, tambahkan trait HasRoles ke model User.',
      checks:['composer require spatie/laravel-permission','php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider"','Tambahkan HasRoles ke app/Models/User.php','php artisan migrate','Cek tabel roles & permissions ada di database'],
      deps:['S0-02']
    },
    {
      id:'S0-04', list:'backlog', title:'Buat migration tabel bagian & surat_masuk',
      tags:['db'], pri:'high', est:'2 jam',
      story:'Sebagai developer, saya ingin tabel database siap agar data bisa disimpan dengan benar.',
      desc:'Buat 2 migration: tabel bagian (master data), surat_masuk dengan semua kolom lengkap termasuk enum status.',
      checks:['Buat migration create_bagian_table (id, nama_bagian, kode_bagian unique, timestamps)','Buat migration create_surat_masuk_table dengan semua kolom (nomor_agenda unique, status enum, tingkat_urgensi enum, dibuat_oleh FK)','Tambah kolom bagian_id & is_active ke tabel users','php artisan migrate → semua tabel terbuat','Cek struktur tabel di MySQL client (DBeaver/TablePlus)'],
      deps:['S0-03']
    },
    {
      id:'S0-05', list:'backlog', title:'Buat Model SuratMasuk & Bagian',
      tags:['be'], pri:'high', est:'1.5 jam',
      story:'Sebagai developer, saya ingin model Eloquent agar bisa berinteraksi dengan database.',
      desc:'Buat model dengan fillable, casts, dan relasi yang benar.',
      checks:['Buat app/Models/Bagian.php dengan fillable','Buat app/Models/SuratMasuk.php dengan fillable lengkap','Tambah casts untuk status (string enum), is_rahasia (boolean), tanggal (date)','Tambah relasi: dibuat() belongsTo User, disposisi() hasMany','Tambah scope: scopeMenungguWarek, scopeMenungguRektor'],
      deps:['S0-04']
    },
    {
      id:'S0-06', list:'backlog', title:'Buat Seeder: roles, permissions, users, bagian',
      tags:['be'], pri:'high', est:'2 jam',
      story:'Sebagai developer, saya ingin data dummy tersedia agar bisa test login semua role.',
      desc:'Buat seeder lengkap untuk roles Spatie, 3 user per role, dan data bagian dummy.',
      checks:['Buat RoleSeeder: buat role admin, wakil_rektor, rektor, bagian_terkait','Buat UserSeeder: 1 akun per role (email + password berbeda per role)','Buat BagianSeeder: 4 bagian dummy (BAK, SDM, KEU, UMUM)','Daftarkan semua seeder ke DatabaseSeeder.php','php artisan db:seed → test login semua akun'],
      deps:['S0-03','S0-04']
    },
    {
      id:'S0-07', list:'backlog', title:'Setup middleware & route per role',
      tags:['be'], pri:'high', est:'2 jam',
      story:'Sebagai developer, saya ingin route terlindungi per role agar user tidak bisa akses halaman yang bukan haknya.',
      desc:'Konfigurasi route group dengan prefix dan middleware role Spatie. Buat redirect setelah login per role.',
      checks:['Buat route group admin/ dengan middleware role:admin','Buat route group warek/ dengan middleware role:wakil_rektor','Buat route group rektor/ dengan middleware role:rektor','Buat AuthenticatedSessionController redirect ke dashboard sesuai role setelah login','Test: login admin → ke /admin/dashboard, login warek → ke /warek/dashboard'],
      deps:['S0-06']
    },
    {
      id:'S0-08', list:'backlog', title:'Buat layout blade & sidebar dinamis',
      tags:['fe'], pri:'med', est:'3 jam',
      story:'Sebagai pengguna, saya ingin tampilan yang berbeda per role agar mudah navigasi sesuai tugas saya.',
      desc:'Buat layout utama dengan sidebar. Isi sidebar berubah tergantung role yang sedang login.',
      checks:['Buat resources/views/layouts/app.blade.php (sidebar + header + content)','Buat komponen sidebar yang cek role: @role("admin") tampil menu admin @endrole','Buat halaman dashboard kosong untuk 3 role (admin, warek, rektor)','Pastikan logout berfungsi','Test: setiap role lihat menu yang berbeda'],
      deps:['S0-07']
    },
  ],

  s1: [
    {
      id:'S1-01', list:'backlog', title:'Buat SuratMasukController (Admin) — CRUD',
      tags:['be'], pri:'high', est:'2 jam',
      story:'Sebagai Admin, saya ingin bisa mengelola surat masuk agar semua data surat tercatat di sistem.',
      desc:'Buat controller di folder Admin/ menggunakan Route::resource. Implementasi index, create, store, show, edit, update.',
      checks:['Buat app/Http/Controllers/Admin/SuratMasukController.php','Method index(): query semua surat_masuk user ini, paginate(10)','Method create(): return view form tambah surat','Method store(): validasi + simpan + handle upload file','Method show(): tampilkan detail surat','Method edit() & update(): form edit surat (hanya jika status = draft)'],
      deps:['S0-08']
    },
    {
      id:'S1-02', list:'backlog', title:'Buat Form Request validasi surat masuk',
      tags:['be'], pri:'high', est:'1 jam',
      story:'Sebagai Admin, saya ingin form yang memvalidasi input agar data yang masuk ke database selalu valid.',
      desc:'Buat StoreSuratMasukRequest dengan semua rules validasi termasuk file upload.',
      checks:['Buat app/Http/Requests/StoreSuratMasukRequest.php','Rules: nomor_surat required string max:100, tanggal_surat required date, asal_surat required string, perihal required string max:500','Rules file: nullable|file|mimes:pdf,jpg,jpeg,png|max:5120 (5MB)','Rules enum: jenis_surat, tingkat_urgensi (in: normal,segera,sangat_segera)','Test validasi error message muncul di form'],
      deps:['S1-01']
    },
    {
      id:'S1-03', list:'backlog', title:'Implementasi upload file surat (PDF/gambar)',
      tags:['be'], pri:'high', est:'1.5 jam',
      story:'Sebagai Admin, saya ingin bisa upload scan surat agar file digitalnya tersimpan di sistem.',
      desc:'Simpan file ke storage/app/public/surat-masuk/. Buat symlink storage:link. Tampilkan link file di detail.',
      checks:['Pastikan php artisan storage:link sudah dijalankan','Di SuratMasukService::simpan(): $file->store("surat-masuk", "public")','Simpan path ke kolom file_path di database','Di view detail: tampilkan tombol "Lihat File" yang buka file di tab baru','Test: upload PDF → file tersimpan → bisa dibuka dari browser'],
      deps:['S1-01','S1-02']
    },
    {
      id:'S1-04', list:'backlog', title:'View: Form tambah surat masuk',
      tags:['fe'], pri:'high', est:'2.5 jam',
      story:'Sebagai Admin, saya ingin form input yang lengkap dan mudah digunakan untuk mencatat surat masuk.',
      desc:'Buat form 2 kolom dengan semua field surat masuk. Tambah input file dengan preview nama file.',
      checks:['Buat resources/views/admin/surat-masuk/create.blade.php','Field: nomor_surat, tanggal_surat, tanggal_diterima, asal_surat, perihal','Field: dropdown jenis_surat, radio tingkat_urgensi, checkbox is_rahasia','Input file dengan teks "Pilih file PDF/gambar (maks 5MB)"','Tampilkan error validasi di bawah setiap field','Tombol Simpan dan Batal'],
      deps:['S1-02']
    },
    {
      id:'S1-05', list:'backlog', title:'View: Daftar surat masuk (tabel + filter status)',
      tags:['fe'], pri:'high', est:'2 jam',
      story:'Sebagai Admin, saya ingin melihat semua surat masuk dengan status yang jelas agar mudah memantau.',
      desc:'Tabel dengan kolom utama, badge status berwarna, dan filter sederhana.',
      checks:['Buat resources/views/admin/surat-masuk/index.blade.php','Kolom tabel: No. Agenda, Perihal, Asal Surat, Tanggal Diterima, Status, Aksi','Badge status: draft=abu, menunggu_warek=kuning, menunggu_rektor=biru, selesai=hijau, dikembalikan=merah','Tombol aksi: Lihat, Edit (jika draft), Hapus (jika draft)','Pagination di bawah tabel'],
      deps:['S1-01']
    },
    {
      id:'S1-06', list:'backlog', title:'View: Halaman detail surat masuk',
      tags:['fe'], pri:'high', est:'2 jam',
      story:'Sebagai Admin/Warek/Rektor, saya ingin melihat detail lengkap surat agar bisa membuat keputusan.',
      desc:'Halaman detail dengan semua info surat, link file, catatan per role, dan timeline status.',
      checks:['Buat resources/views/surat-masuk/show.blade.php (shared semua role)','Tampilkan semua kolom surat dalam layout info rows','Tampilkan link "Lihat File" jika file_path ada','Tampilkan catatan_warek jika ada (dengan label "Catatan Warek Rektor:")','Tampilkan catatan_rektor jika ada (dengan label "Catatan Rektor:")','Timeline status sederhana: langkah-langkah dengan lingkaran filled/empty'],
      deps:['S1-05']
    },
    {
      id:'S1-07', list:'backlog', title:'Action: Admin ajukan surat ke Wakil Rektor',
      tags:['be'], pri:'high', est:'1 jam',
      story:'Sebagai Admin, saya ingin mengajukan surat ke Wakil Rektor agar proses review bisa dimulai.',
      desc:'Tombol "Ajukan ke Warek" di halaman detail. Update status dari draft ke menunggu_warek.',
      checks:['Tambah route PATCH admin/surat-masuk/{id}/ajukan','Tambah method ajukan() di SuratMasukController Admin','Validasi: hanya bisa diajukan jika status = draft','Update: $surat->update(["status" => "menunggu_warek"])','Flash message: "Surat berhasil diajukan ke Wakil Rektor"','Tombol hanya tampil jika status = draft'],
      deps:['S1-06']
    },
    {
      id:'S1-08', list:'backlog', title:'Testing manual modul Admin Sprint 1',
      tags:['tst'], pri:'high', est:'2 jam',
      story:'Sebagai QA, saya ingin memastikan semua fitur Admin Sprint 1 berjalan benar sebelum lanjut.',
      desc:'Test seluruh alur dari login Admin sampai ajukan surat ke Warek.',
      checks:['Login sebagai Admin → berhasil masuk ke /admin/dashboard','Input surat masuk lengkap → tersimpan di database','Upload file PDF → file ada di storage/app/public/surat-masuk/','Cek daftar surat → data tampil dengan benar','Buka halaman detail → semua info tampil','Klik Ajukan ke Warek → status berubah ke menunggu_warek','Login sebagai Warek → surat muncul di daftar'],
      deps:['S1-07']
    },
    {
      id:'S1-09', list:'backlog', title:'Daftarkan & sesuaikan route resource surat masuk',
      tags:['be'], pri:'high', est:'30 mnt',
      story:'Sebagai developer, saya ingin route terorganisir agar URL sistem konsisten dan terproteksi.',
      desc:'Daftarkan Route::resource di web.php dalam group admin. Tambahkan route tambahan untuk action ajukan.',
      checks:['Buka routes/web.php','Di dalam group middleware role:admin, tambah: Route::resource("surat-masuk", Admin\\SuratMasukController::class)','Tambah: Route::patch("surat-masuk/{id}/ajukan", [...]) ->name("admin.surat-masuk.ajukan")','php artisan route:list → cek semua route admin/surat-masuk ada','Test URL /admin/surat-masuk → tampil halaman index'],
      deps:['S1-01']
    },
  ],

  s2: [
    {
      id:'S2-01', list:'backlog', title:'Buat WakilRektorController — daftar surat menunggu review',
      tags:['be'], pri:'high', est:'1.5 jam',
      story:'Sebagai Wakil Rektor, saya ingin melihat daftar surat yang perlu saya review agar tidak ada yang terlewat.',
      desc:'Controller Wakil Rektor hanya tampilkan surat dengan status menunggu_warek.',
      checks:['Buat app/Http/Controllers/WakilRektor/SuratMasukController.php','Method index(): SuratMasuk::where("status","menunggu_warek")->paginate(10)','Method show(): tampilkan detail + tombol aksi Warek','Daftarkan route di group warek/ di web.php','Test: login Warek → hanya lihat surat menunggu_warek'],
      deps:['S1-07']
    },
    {
      id:'S2-02', list:'backlog', title:'View: Daftar & detail surat untuk Wakil Rektor',
      tags:['fe'], pri:'high', est:'2 jam',
      story:'Sebagai Wakil Rektor, saya ingin tampilan yang jelas agar mudah membaca isi surat sebelum memutuskan.',
      desc:'Reuse view detail yang sudah ada dari Sprint 1. Tambahkan panel aksi khusus Warek.',
      checks:['Buat resources/views/warek/surat-masuk/index.blade.php (tabel sederhana)','Reuse views/surat-masuk/show.blade.php untuk detail','Tambah panel "Tindakan Anda" di halaman detail surat (hanya jika role = warek)','Panel berisi: textarea catatan, tombol Teruskan ke Rektor, tombol Kembalikan','Catatan WAJIB diisi jika klik Kembalikan (validasi client-side)'],
      deps:['S2-01']
    },
    {
      id:'S2-03', list:'backlog', title:'Action: Warek teruskan surat ke Rektor',
      tags:['be'], pri:'high', est:'1 jam',
      story:'Sebagai Wakil Rektor, saya ingin meneruskan surat ke Rektor setelah saya review dan setuju.',
      desc:'Method teruskan(). Update status ke menunggu_rektor. Simpan catatan warek jika ada.',
      checks:['Tambah route PATCH warek/surat-masuk/{id}/teruskan','Tambah method teruskan() di WakilRektorController','Validasi: surat harus status menunggu_warek','Update: status = menunggu_rektor, catatan_warek = input catatan (nullable)','Flash message: "Surat diteruskan ke Rektor"','Redirect ke daftar surat Warek'],
      deps:['S2-02']
    },
    {
      id:'S2-04', list:'backlog', title:'Action: Warek kembalikan surat ke Admin',
      tags:['be'], pri:'high', est:'1 jam',
      story:'Sebagai Wakil Rektor, saya ingin mengembalikan surat ke Admin jika ada yang perlu diperbaiki.',
      desc:'Method kembalikan(). Catatan WAJIB diisi. Update status ke dikembalikan.',
      checks:['Tambah route PATCH warek/surat-masuk/{id}/kembalikan','Tambah method kembalikan() di WakilRektorController','Validasi: catatan WAJIB diisi (required|string|min:10)','Update: status = dikembalikan, catatan_warek = catatan','Flash message: "Surat dikembalikan ke Admin dengan catatan"','Test: Admin login → surat muncul di daftar dengan status dikembalikan'],
      deps:['S2-02']
    },
    {
      id:'S2-05', list:'backlog', title:'Handling surat dikembalikan: Admin bisa edit & ajukan ulang',
      tags:['be','fe'], pri:'high', est:'1.5 jam',
      story:'Sebagai Admin, saya ingin bisa memperbaiki surat yang dikembalikan dan mengajukan ulang.',
      desc:'Tampilkan catatan Warek di halaman detail Admin. Ijinkan edit jika status = dikembalikan. Tambah tombol "Ajukan Ulang".',
      checks:['Di halaman detail Admin: tampilkan catatan_warek jika status = dikembalikan','Tombol Edit dan Ajukan Ulang muncul jika status = draft atau dikembalikan','Method ajukan() ubah: cek status = draft OR dikembalikan','Flash message berbeda: "Surat berhasil diajukan ulang ke Wakil Rektor"','Test alur penuh: Admin ajukan → Warek kembalikan → Admin lihat catatan → Admin edit → Ajukan ulang'],
      deps:['S2-04']
    },
    {
      id:'S2-06', list:'backlog', title:'Update view detail: tampilkan catatan per role',
      tags:['fe'], pri:'med', est:'1 jam',
      story:'Sebagai semua role, saya ingin melihat catatan dari setiap tahap agar tahu riwayat surat.',
      desc:'Update halaman detail untuk menampilkan catatan_warek dan catatan_rektor secara kondisional.',
      checks:['Jika catatan_warek ada → tampilkan kotak "Catatan Wakil Rektor" dengan teks catatan','Jika catatan_rektor ada → tampilkan kotak "Catatan Rektor" dengan teks catatan','Styling kotak catatan berbeda per role (warna berbeda)','Kotak catatan tidak tampil jika kosong/null','Test: surat yang sudah punya catatan warek → catatan muncul di detail'],
      deps:['S2-03','S2-04']
    },
    {
      id:'S2-07', list:'backlog', title:'Testing manual Sprint 2 — alur Wakil Rektor',
      tags:['tst'], pri:'high', est:'2 jam',
      story:'Sebagai QA, saya ingin memastikan alur review Warek berjalan benar sebelum lanjut ke Sprint 3.',
      desc:'Test lengkap alur Admin → Warek (teruskan dan kembalikan).',
      checks:['Login Admin → input surat → ajukan ke Warek','Login Warek → lihat surat di daftar','Warek klik Teruskan → cek status berubah ke menunggu_rektor','Login Admin → surat sudah tidak bisa diedit (status bukan draft/dikembalikan)','Login Warek → input surat baru → ajukan, Warek klik Kembalikan TANPA catatan → error','Warek isi catatan → klik Kembalikan → berhasil','Login Admin → lihat catatan Warek di detail → edit → ajukan ulang'],
      deps:['S2-06']
    },
  ],

  s3: [
    {
      id:'S3-01', list:'backlog', title:'Buat RektorController — daftar surat menunggu persetujuan',
      tags:['be'], pri:'high', est:'1.5 jam',
      story:'Sebagai Rektor, saya ingin melihat surat yang perlu saya setujui agar tidak ada yang tertunda.',
      desc:'Controller Rektor filter surat status menunggu_rektor. Tampilkan catatan Warek.',
      checks:['Buat app/Http/Controllers/Rektor/SuratMasukController.php','Method index(): SuratMasuk::where("status","menunggu_rektor")->paginate(10)','Method show(): tampilkan detail + catatan_warek + panel aksi Rektor','Daftarkan route di group rektor/ di web.php','Test: login Rektor → hanya lihat surat menunggu_rektor'],
      deps:['S2-07']
    },
    {
      id:'S3-02', list:'backlog', title:'Action: Rektor approve surat → status selesai',
      tags:['be'], pri:'high', est:'1 jam',
      story:'Sebagai Rektor, saya ingin menyetujui surat yang sudah direview Warek agar prosesnya selesai.',
      desc:'Method approve(). Update status ke selesai. Simpan catatan Rektor opsional.',
      checks:['Tambah route PATCH rektor/surat-masuk/{id}/approve','Tambah method approve() di RektorController','Validasi: surat harus status menunggu_rektor','Update: status = selesai, catatan_rektor = catatan (nullable)','Flash message: "Surat telah disetujui"','Redirect ke daftar surat Rektor'],
      deps:['S3-01']
    },
    {
      id:'S3-03', list:'backlog', title:'Action: Rektor kembalikan surat',
      tags:['be'], pri:'med', est:'1 jam',
      story:'Sebagai Rektor, saya ingin bisa mengembalikan surat jika ada yang perlu dikoreksi lebih lanjut.',
      desc:'Method kembalikan() di RektorController. Catatan wajib. Update status ke dikembalikan.',
      checks:['Tambah route PATCH rektor/surat-masuk/{id}/kembalikan','Method kembalikan(): validasi catatan wajib, update status = dikembalikan & catatan_rektor','Flash message: "Surat dikembalikan"','Test: Admin lihat surat dikembalikan dari Rektor + catatan muncul'],
      deps:['S3-01']
    },
    {
      id:'S3-04', list:'backlog', title:'View: Halaman panel aksi Rektor',
      tags:['fe'], pri:'high', est:'1.5 jam',
      story:'Sebagai Rektor, saya ingin tampilan aksi yang jelas dan tidak bisa salah klik.',
      desc:'Panel di halaman detail surat untuk Rektor. Tombol Approve berwarna hijau, Kembalikan berwarna merah.',
      checks:['Tambah panel aksi di show.blade.php (hanya jika role = rektor dan status = menunggu_rektor)','Tombol "Setujui Surat" → hijau, konfirmasi dialog sebelum submit','Tombol "Kembalikan Surat" → merah, expand textarea catatan','Catatan Rektor required jika klik Kembalikan','Tampilkan catatan_warek di panel Rektor agar Rektor tahu konteks review Warek'],
      deps:['S3-02']
    },
    {
      id:'S3-05', list:'backlog', title:'Disposisi sederhana: Rektor pilih bagian terkait',
      tags:['be','fe'], pri:'high', est:'2.5 jam',
      story:'Sebagai Rektor, saya ingin mendisposisikan surat ke bagian yang relevan agar ditindaklanjuti.',
      desc:'Form disposisi simpel di halaman detail (setelah approve). Simpan ke tabel disposisi + pivot disposisi_bagian.',
      checks:['Migration disposisi & disposisi_bagian (jika belum ada)','Model Disposisi dengan relasi belongsToMany Bagian','Di halaman detail (status = selesai): tampilkan form disposisi','Form: checkbox multi-bagian (dari tabel bagian), textarea instruksi','Method storeDisposisi(): simpan ke disposisi + attach ke disposisi_bagian','Tampilkan daftar disposisi yang sudah dibuat di halaman detail'],
      deps:['S3-04']
    },
    {
      id:'S3-06', list:'backlog', title:'Update timeline status di halaman detail',
      tags:['fe'], pri:'med', est:'1.5 jam',
      story:'Sebagai semua pengguna, saya ingin melihat riwayat status surat agar tahu sudah sampai mana prosesnya.',
      desc:'Timeline visual langkah-langkah status. Lingkaran terisi = sudah lewat, kosong = belum.',
      checks:['Buat komponen timeline di show.blade.php','Langkah: Draft → Menunggu Warek → Menunggu Rektor → Selesai','Warna: hijau = sudah lewat, abu = belum, kuning = sedang di sini','Jika dikembalikan: tampilkan langkah "Dikembalikan" dengan warna merah','Test: buka surat berbeda status → timeline sesuai'],
      deps:['S3-04']
    },
    {
      id:'S3-07', list:'backlog', title:'Testing manual Sprint 3 — alur penuh end-to-end',
      tags:['tst'], pri:'high', est:'2 jam',
      story:'Sebagai QA, saya ingin memastikan alur penuh dari Admin sampai Rektor approve berjalan tanpa error.',
      desc:'Test seluruh alur end-to-end: input → warek review → rektor approve → selesai.',
      checks:['Login Admin → input surat → ajukan ke Warek','Login Warek → teruskan ke Rektor','Login Rektor → lihat catatan Warek → approve → status = selesai','Cek semua role tidak bisa akses route role lain','Test Rektor kembalikan surat → catatan muncul → Admin revisi → ajukan ulang','Test disposisi: Rektor approve → isi form disposisi → data tersimpan di database','Cek timeline status tampil benar di setiap langkah'],
      deps:['S3-06']
    },
  ],

  s4: [
    {
      id:'S4-01', list:'backlog', title:'Dashboard Admin — statistik surat masuk',
      tags:['be','fe'], pri:'high', est:'2 jam',
      story:'Sebagai Admin, saya ingin melihat ringkasan data agar tahu kondisi surat masuk secara cepat.',
      desc:'Dashboard sederhana dengan 4 kartu statistik dan tabel surat terbaru.',
      checks:['DashboardController: hitung total surat per status','Kartu: Surat Masuk Hari Ini, Menunggu Diproses, Menunggu Warek, Selesai Bulan Ini','Tabel 5 surat terbaru dengan kolom no. agenda, perihal, status, aksi Lihat','Semua angka pakai query Eloquent (bukan COUNT raw SQL)','Test data akurat sesuai data di database'],
      deps:['S3-07']
    },
    {
      id:'S4-02', list:'backlog', title:'Dashboard Warek & Rektor — surat perlu ditindak',
      tags:['be','fe'], pri:'high', est:'1.5 jam',
      story:'Sebagai Warek/Rektor, saya ingin langsung tahu berapa surat yang perlu saya tindak lanjuti.',
      desc:'Dashboard fokus: jumlah surat menunggu tindakan + tabel daftar singkat.',
      checks:['Dashboard Warek: kartu "Surat Perlu Direview" + tabel 5 terbaru','Dashboard Rektor: kartu "Surat Perlu Disetujui" + tabel 5 terbaru','Highlight kartu dengan warna amber jika ada surat menunggu','Tombol "Lihat Semua" arahkan ke daftar surat role tersebut'],
      deps:['S4-01']
    },
    {
      id:'S4-03', list:'backlog', title:'Fitur pencarian & filter sederhana',
      tags:['be','fe'], pri:'med', est:'2 jam',
      story:'Sebagai Admin, saya ingin bisa mencari surat agar mudah menemukan surat tertentu.',
      desc:'Tambah input pencarian di halaman daftar surat masuk. Filter by status.',
      checks:['Form pencarian di atas tabel: input keyword (cari perihal/asal_surat/nomor_surat)','Dropdown filter status: Semua, Draft, Menunggu Warek, Menunggu Rektor, Selesai, Dikembalikan','Query: if request has search → SuratMasuk::where("perihal","like","%{search}%")','Pertahankan nilai filter saat halaman diload ulang (prefill input)','Pagination tetap berfungsi saat filter aktif'],
      deps:['S4-01']
    },
    {
      id:'S4-04', list:'backlog', title:'Polish UI — konsistensi visual semua halaman',
      tags:['fe'], pri:'med', est:'3 jam',
      story:'Sebagai pengguna, saya ingin tampilan yang bersih dan konsisten agar nyaman dipakai sehari-hari.',
      desc:'Review semua halaman, perbaiki spacing, warna badge status, dan responsivitas.',
      checks:['Cek semua badge status konsisten warnanya di semua halaman','Perbaiki padding/margin yang tidak konsisten','Pastikan tabel tidak overflow di layar laptop 13 inch','Flash message (sukses/gagal) tampil dengan gaya yang jelas','Tombol aksi konsisten: primary=biru, danger=merah, secondary=abu','Halaman kosong (tidak ada data): tampilkan pesan "Belum ada surat masuk"'],
      deps:['S4-03']
    },
    {
      id:'S4-05', list:'backlog', title:'Error handling & validasi yang ramah pengguna',
      tags:['be','fe'], pri:'med', est:'1.5 jam',
      story:'Sebagai pengguna, saya ingin pesan error yang jelas agar tahu apa yang perlu diperbaiki.',
      desc:'Perbaiki semua error message, tambah halaman 403, pastikan semua form punya error display.',
      checks:['Buat resources/views/errors/403.blade.php (akses ditolak)','Buat resources/views/errors/404.blade.php (halaman tidak ditemukan)','Pastikan semua form tampilkan @error di bawah setiap input','Flash message: @if(session("success")) → kotak hijau, @if(session("error")) → kotak merah','Konfirmasi sebelum hapus: "Yakin ingin menghapus surat ini?"'],
      deps:['S4-04']
    },
    {
      id:'S4-06', list:'backlog', title:'Security checklist & final review',
      tags:['be'], pri:'high', est:'1.5 jam',
      story:'Sebagai developer, saya ingin memastikan sistem aman sebelum dipresentasikan ke klien.',
      desc:'Cek semua poin keamanan dasar Laravel.',
      checks:['CSRF token ada di semua form ({{ @csrf_field() }})','Semua route dilindungi middleware auth','Route per role dilindungi middleware role:xxx','File surat tidak bisa diakses langsung tanpa login (serve via controller)','Validasi semua input di Form Request (tidak ada yang bypass)','Cek .env APP_DEBUG masih true di development (jangan lupa ubah false di production)'],
      deps:['S4-05']
    },
    {
      id:'S4-07', list:'backlog', title:'Testing final & persiapan UAT klien',
      tags:['tst'], pri:'high', est:'2 jam',
      story:'Sebagai PM, saya ingin sistem siap dipresentasikan ke klien dan dosen.',
      desc:'Full regression test semua fitur + buat checklist UAT untuk klien.',
      checks:['Login semua 3 role → berhasil masuk ke dashboard yang benar','Full flow: Admin input → Warek teruskan → Rektor approve → selesai','Full flow: Admin input → Warek kembalikan → Admin revisi → Ajukan ulang','Full flow: Rektor approve → disposisi ke 2 bagian → data tersimpan','Dashboard semua role menampilkan data akurat','Pencarian berfungsi: cari keyword yang ada → tampil, yang tidak ada → kosong','Semua halaman tidak ada error PHP di log (storage/logs/laravel.log)'],
      deps:['S4-06']
    },
  ],
};

// ══ BUILD BOARD ════════════════════════════════════════════════════

function buildBoard(sprintKey) {
  const boardEl = document.getElementById(`board-${sprintKey}`);
  if (!boardEl || boardEl.childElementCount > 0) return;

  const taskList = tasks[sprintKey];
  const col = sprintColors[sprintKey];

  listDefs.forEach(list => {
    const listTasks = taskList.filter(t => t.list === list.id);

    const listEl = document.createElement('div');
    listEl.className = 'list';
    listEl.innerHTML = `
      <div class="list-head">
        <div class="list-title">
          <span style="width:8px;height:8px;border-radius:50%;background:${list.dot};display:inline-block"></span>
          ${list.label}
        </div>
        <div class="list-count">${listTasks.length}</div>
      </div>
      <div class="list-body" id="lb-${sprintKey}-${list.id}"></div>
    `;
    boardEl.appendChild(listEl);

    const body = listEl.querySelector('.list-body');
    listTasks.forEach(task => {
      body.appendChild(buildCard(task, col));
    });
  });
}

function buildCard(task, col) {
  const card = document.createElement('div');
  card.className = 'card';
  card.onclick = () => openModal(task, col);

  const checkDone = task.checks.filter((_, i) => i < 0).length;

  card.innerHTML = `
    <div class="card-accent" style="background:${col.accent}"></div>
    <div class="card-id">${task.id}</div>
    <div class="card-title">${task.title}</div>
    <div class="card-tags">
      ${task.tags.map(t => `<span class="tag tag-${t}">${tagLabel(t)}</span>`).join('')}
    </div>
    <div class="card-footer">
      <div class="card-est">⏱ ${task.est}</div>
      <span class="card-pri pri-${task.pri}">${task.pri}</span>
    </div>
    <div class="card-check" style="margin-top:6px;padding-left:6px">☐ ${task.checks.length} checklist</div>
  `;
  return card;
}

function tagLabel(t) {
  const m = { be:'Backend', fe:'Frontend', db:'Database', cfg:'Config', tst:'Testing', doc:'Docs' };
  return m[t] || t;
}

// ══ MODAL ══════════════════════════════════════════════════════════

function openModal(task, col) {
  document.getElementById('m-badge').textContent = task.id;
  document.getElementById('m-badge').style.background = col.bg;
  document.getElementById('m-badge').style.color = col.text;
  document.getElementById('m-title').textContent = task.title;

  const body = document.getElementById('m-body');
  body.innerHTML = `
    <div class="modal-section">
      <div class="ms-label">User Story</div>
      <div class="ms-story">${task.story}</div>
    </div>
    <div class="modal-section">
      <div class="ms-label">Deskripsi Task</div>
      <div class="ms-desc">${task.desc}</div>
    </div>
    <div class="modal-section">
      <div class="ms-label">Checklist</div>
      <div class="checklist">
        ${task.checks.map((c,i) => `
          <div class="ci" onclick="toggleCheck(this)" id="ci-${task.id}-${i}">
            <div class="cbox"></div>
            <span>${c}</span>
          </div>
        `).join('')}
      </div>
    </div>
    <div class="modal-section">
      <div class="ms-label">Detail</div>
      <div class="meta-row">
        <div class="meta-chip"><div class="ml">Estimasi</div><div class="mv">⏱ ${task.est}</div></div>
        <div class="meta-chip"><div class="ml">Prioritas</div><div class="mv">${task.pri.toUpperCase()}</div></div>
      </div>
    </div>
    ${task.deps.length ? `
    <div class="modal-section">
      <div class="ms-label">Dependency</div>
      <div>${task.deps.map(d => `<span class="dep-tag">${d}</span>`).join('')}</div>
    </div>
    ` : ''}
  `;

  document.getElementById('modal').classList.add('open');
}

function toggleCheck(el) {
  el.classList.toggle('done');
  el.querySelector('.cbox').classList.toggle('done');
}

function closeModal(e) {
  if (!e || e.target === document.getElementById('modal')) {
    document.getElementById('modal').classList.remove('open');
  }
}

// ══ PANEL SWITCHING ════════════════════════════════════════════════

function showPanel(key, btn) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('show'));
  document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('on'));
  document.getElementById(`p-${key}`).classList.add('show');
  btn.classList.add('on');

  if (key !== 'roadmap' && key !== 'trello') {
    buildBoard(key);
  }
}

// ══ DOD TOGGLE ════════════════════════════════════════════════════

function tgDod(el) {
  el.querySelector('.dod-box').classList.toggle('done');
}

// Init roadmap kartu klik handler
document.querySelectorAll('.rm-card').forEach(c => {
  c.addEventListener('click', () => {});
});
</script>
</body>
</html>