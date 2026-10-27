<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Student Management System')</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Inter,sans-serif;background:#e9eef7;color:#1e293b;min-height:100vh;padding:28px 14px}
.wrap{max-width:900px;margin:0 auto;background:#fff;border-radius:22px;overflow:hidden;box-shadow:0 12px 40px rgba(40,50,110,.15)}
.wrap.narrow{max-width:470px}
.hero{background:linear-gradient(135deg,#4361ee,#3a0ca3);color:#fff;text-align:center;padding:26px 22px 24px;position:relative}
.hero .top{position:absolute;top:14px;left:18px;right:18px;display:flex;justify-content:space-between;align-items:center;font-size:12px;font-weight:600}
.hero .top a{color:#fff;text-decoration:none;opacity:.85;margin-right:14px}.hero .top a:hover,.hero .top a.on{opacity:1;text-decoration:underline}
.hero .top form{display:inline}.hero .top button{background:#fff;color:#e11d48;border:0;border-radius:6px;padding:6px 11px;font-weight:700;font-size:11px;cursor:pointer;font-family:inherit}
.hero .cap{font-size:30px;margin-top:20px}
.hero h1{font-size:24px;font-weight:800;margin:4px 0 4px}
.hero p{font-size:12px;opacity:.92}
.stats{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:16px}
.stat{min-width:120px;padding:12px 18px;border-radius:12px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.28)}
.stat b{display:block;font-size:22px;font-weight:800}.stat small{font-size:10px;font-weight:600}
.pad{padding:18px 20px 22px}
.panel{background:#fff;border-radius:12px;box-shadow:0 2px 14px rgba(30,41,90,.08);padding:14px;margin-bottom:16px}
.search{position:relative}.search i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#4361ee;font-size:13px}
.search input{width:100%;padding:12px 14px 12px 38px;border:1px solid #dbe3f0;border-radius:10px;background:#f8fafc;font-family:inherit;font-size:13px;font-weight:500;outline:none}
.search input:focus,.fi:focus,textarea:focus{border-color:#4361ee;box-shadow:0 0 0 3px rgba(67,97,238,.15)}
.chips{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
.chip{display:flex;align-items:center;gap:7px;background:#f1f5f9;border-radius:20px;padding:6px 12px;font-size:11px;font-weight:600;color:#475569}
.chip i{color:#4361ee}.chip select{border:0;background:transparent;font-family:inherit;font-size:11px;font-weight:700;color:#475569;outline:none;cursor:pointer}
table{width:100%;border-collapse:collapse;font-size:12px}
th{text-align:left;padding:12px 8px;font-weight:800;font-size:12px;border-bottom:1px solid #e5e9f2}
td{padding:11px 8px;border-bottom:1px solid #eef1f7;vertical-align:middle}
.nm{font-weight:800;font-size:13px}.gd{font-size:11px;color:#64748b;font-weight:600}
.ln{font-weight:600}.ln i{color:#3b82f6;margin-right:6px;width:12px}
.ln.s{font-size:11px;color:#475569;font-weight:700}
.badge{display:inline-block;background:#e0e7ff;color:#4361ee;font-weight:700;font-size:10.5px;padding:5px 11px;border-radius:16px}.badge i{margin-right:5px}
.acts{display:flex;gap:6px}.acts form{display:inline}
.ic{width:30px;height:30px;border:0;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:12px;cursor:pointer;text-decoration:none}
.ic.v{background:#e0e7ff;color:#4361ee}.ic.e{background:#dcfce7;color:#16a34a}.ic.d{background:#fee2e2;color:#dc2626}
.foot{display:flex;justify-content:space-between;align-items:center;margin:14px 0 16px;font-size:11px;font-weight:600;color:#64748b}
.pg a,.pg span{display:inline-block;padding:7px 13px;border-radius:7px;background:#e8ecfb;color:#4361ee;font-weight:700;font-size:11px;text-decoration:none;margin-left:5px}
.pg span.on{background:#3b4fe0;color:#fff}.pg span.dis{opacity:.45}
.bigbtn{display:block;width:100%;text-align:center;padding:13px;border:0;border-radius:10px;background:linear-gradient(90deg,#4361ee,#3a0ca3);color:#fff;font-weight:700;font-size:13px;text-decoration:none;font-family:inherit;box-shadow:0 6px 16px rgba(67,97,238,.3);cursor:pointer}
.alert{margin:14px 20px 0;padding:10px 14px;border-radius:8px;font-size:12px;font-weight:600;background:#dcfce7;color:#166534}.alert.err{background:#fee2e2;color:#991b1b}
.empty{text-align:center;padding:26px;color:#94a3b8;font-weight:600}
/* forms */
.sec{display:flex;align-items:center;gap:8px;color:#3b4fe0;font-weight:700;font-size:13px;margin:6px 0 10px;padding-bottom:6px;border-bottom:1px solid #eef1f7}
.fld{position:relative;margin-bottom:12px}
.fld>i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#64748b;font-size:11px;pointer-events:none}
.fi{width:100%;padding:11px 14px 11px 34px;border:1px solid #dbe3f0;border-radius:9px;background:#f8fafc;font-family:inherit;font-size:12px;outline:none;color:#1e293b}
.fld label{position:absolute;top:-7px;left:11px;background:#fff;padding:0 4px;font-size:9.5px;font-weight:700;color:#3b4fe0;z-index:1}
.fld label i{margin-right:3px}
select.fi{appearance:none;padding-top:15px;padding-bottom:9px;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%23475569' fill='none' stroke-width='1.5'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center}
input[type=date].fi{padding-top:15px;padding-bottom:7px}
.two{display:grid;grid-template-columns:1fr 1fr;gap:10px}
textarea{width:100%;min-height:78px;padding:11px;border:1px solid #dbe3f0;border-radius:9px;background:#f8fafc;font-family:inherit;font-size:12px;outline:none;resize:vertical}
.lab{font-size:11px;font-weight:800;margin:8px 0 6px;display:flex;gap:7px;align-items:center}.lab i{color:#3b4fe0}
.er{color:#dc2626;font-size:11px;margin:-6px 0 8px 2px;font-weight:600}
.btns{display:flex;gap:10px;margin-top:20px;padding-top:16px;border-top:1px solid #eef1f7}
.btns>*{flex:1;text-align:center;padding:11px 8px;border-radius:9px;border:0;font-family:inherit;font-weight:700;font-size:11px;cursor:pointer;text-decoration:none}
.b1{background:linear-gradient(90deg,#4361ee,#3a0ca3);color:#fff;box-shadow:0 5px 12px rgba(67,97,238,.3)}
.b2{background:#f1f2f7;color:#475569}.b3{background:linear-gradient(90deg,#4cc9f0,#3b82f6);color:#fff}
.det{list-style:none}.det li{padding:11px 4px;border-bottom:1px solid #eef1f7;font-size:13px}.det b{display:inline-block;min-width:140px;color:#3b4fe0}
@media(max-width:700px){.two{grid-template-columns:1fr}.hm{display:none}.hero .top{position:static;margin-bottom:6px}}
</style>
</head>
<body>
<div class="wrap @yield('shell')">
  @yield('content')
</div>
</body>
</html>
