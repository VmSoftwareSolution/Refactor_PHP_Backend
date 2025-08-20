<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Control</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    :root {
      --primary-color: #7f56d9;
      --primary-light: #f3f4f6;
      --text-dark: #111827;
      --text-light: #6b7280;
      --body-bg: #f9fafb;
      --card-bg: #fff;
      --border-color: #e5e7eb;
      --success-color: #10b981;
      --danger-color: #ef4444;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Inter',sans-serif;background:var(--body-bg);color:var(--text-dark);}
    .main{padding:25px 30px;max-width:1200px;margin:auto}
    .header{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px}
    .header h1{font-size:1.8em;font-weight:600}
    .header-search-container{background:#fff;border-radius:22px;padding:5px;box-shadow:0 1px 3px rgba(0,0,0,.07);display:flex;align-items:center;width:280px}
    .header-search{display:flex;align-items:center;flex-grow:1;padding:5px 10px;gap:8px}
    .header-search i{color:#9ca3af}
    .header-search input{border:none;flex-grow:1;font-size:.9em;outline:none;background:transparent;color:#111827}
    .dashboard-content{display:flex;flex-direction:column;gap:24px}
    .card{background:var(--card-bg);padding:25px;border-radius:16px;display:flex;flex-direction:column;box-shadow:0 4px 10px rgba(0,0,0,.05);transition:transform .3s ease,box-shadow .3s ease}
    .card:hover{transform:translateY(-5px);box-shadow:0 8px 20px rgba(0,0,0,.08)}
    .grid-row{display:grid;gap:24px}
    .grid-row:not(.bottom-row){grid-template-columns:2.5fr 1fr}
    .bottom-row{grid-template-columns:2.5fr 1fr 1fr}
    .overview-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px}
    .overview-cards .card{background:#111;color:#fff;justify-content:center;align-items:center;gap:15px;text-align:center}
    .overview-cards .card i{background:#333;color:#fff;padding:12px;border-radius:50%}
    .overview-cards .card h3{color:#ccc;font-size:.9em;font-weight:500}
    .overview-cards .card p{font-size:1.8em;font-weight:600;color:#fff}
    .percentage.positive{color:var(--success-color)}.percentage.neutral{color:var(--danger-color)}
    .chart-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
    .chart-controls button{border:1px solid var(--border-color);background:#fff;padding:6px 14px;margin-left:5px;border-radius:8px;cursor:pointer;font-size:.85em;font-weight:500}
    .chart-controls button.active{background:var(--primary-color);color:#fff}
    .chart-canvas-container{flex-grow:1;position:relative;min-height:250px}
    canvas{position:absolute;top:0;left:0;width:100%;height:100%}
    .income-summary-card{text-align:center}
    .income-amount{font-size:2em;font-weight:700;margin:5px 0 15px}
    .income-chart-container{min-height:150px}
    .recent-orders-card table{width:100%;border-collapse:collapse}
    .recent-orders-card th,.recent-orders-card td{padding:12px 10px;font-size:.85em;border-bottom:1px solid var(--primary-light)}
    .recent-orders-card th{text-align:left;color:var(--text-light);font-weight:600}
    .status{padding:4px 10px;border-radius:9999px;font-size:.75em;font-weight:600}
    .status.approved{background:#d1fae5;color:#065f46}
    .status.rejected{background:#fee2e2;color:#991b1b}
    .status.pending{background:#fef3c7;color:#92400e}
    .analysis-item{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px}
    .analysis-item p{color:var(--text-light)}.analysis-item .value{font-weight:600}
    .analysis-item .value.positive{color:var(--success-color)}
    .analysis-item .value.status-low{background:var(--primary-light);color:var(--primary-color);padding:3px 10px;border-radius:6px}
    .analysis-chart-container{height:120px}
    .sales-report-card .net-benefit{font-size:.9em;color:var(--text-light)}
    .sales-report-card .net-benefit-amount{font-size:1.8em;font-weight:700;margin:4px 0 15px}
    .chart-controls.text-style button{border:none;background:none;color:var(--text-light)}
    .chart-controls.text-style button.active{color:var(--primary-color);font-weight:600}
    .transaction-item{display:flex;align-items:center;padding:8px 0;border-bottom:1px solid var(--border-color)}
    .transaction-icon{width:32px;height:32px;border-radius:50%;margin-right:12px;display:flex;align-items:center;justify-content:center;font-size:1.2em}
    .transaction-icon.green-bg{background:#d1fae5;color:#065f46}
    .transaction-icon.blue-bg{background:var(--primary-light);color:var(--primary-color)}
    .chat-support-card{text-align:center}
    .chat-avatars{display:flex;justify-content:center;margin-bottom:12px}
    .chat-avatars img{width:36px;height:36px;border-radius:50%;border:3px solid var(--card-bg);margin-left:-10px}
    .help-button{background-color:var(--primary-color);color:#fff;border:none;padding:10px 20px;border-radius:6px;cursor:pointer;font-size:.9em;font-weight:500}
    @media(max-width:992px){.grid-row{grid-template-columns:1fr}.bottom-row{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <main class="main">
    <header class="header">
      <h1>Hola, Brayan 👋</h1>
      <div class="header-search-container">
        <div class="input-icon header-search">
          <i data-lucide="search"></i><input type="text" placeholder="Buscar..." />
        </div>
      </div>
    </header>

    <div class="dashboard-content">
      <section class="overview-cards">
        <div class="card"><i data-lucide="eye"></i><div><h3>Total de visitas</h3><p>4.42.236 <span class="percentage positive">+59.3%</span></p></div></div>
        <div class="card"><i data-lucide="users-2"></i><div><h3>Total de usuarios</h3><p>78.250 <span class="percentage positive">+70.5%</span></p></div></div>
        <div class="card"><i data-lucide="shopping-cart"></i><div><h3>Pedidos</h3><p>18.800 <span class="percentage neutral">+27.4%</span></p></div></div>
        <div class="card"><i data-lucide="dollar-sign"></i><div><h3>Ventas</h3><p>$35,078 <span class="percentage neutral">+27.4%</span></p></div></div>
      </section>

      <section class="grid-row top-row">
        <div class="card unique-visitor-card">
          <div class="chart-header"><h3>Visitante único</h3><div class="chart-controls"><button class="active">Mes</button><button>Semana</button></div></div>
          <div class="chart-canvas-container"><canvas id="uniqueVisitorChart"></canvas></div>
        </div>
        <div class="card income-summary-card">
          <h3>Resumen de Ingresos</h3><p class="this-week-stats">Estadísticas de esta semana</p><p class="income-amount">$7,650</p>
          <div class="chart-canvas-container income-chart-container"><canvas id="weeklyIncomeChart"></canvas></div>
        </div>
      </section>

      <section class="grid-row middle-row">
        <div class="card recent-orders-card">
          <h3>Pedidos recientes</h3>
          <table><thead><tr><th>FECHA</th><th>PRODUCTO</th><th>ESTADO</th><th>IMPORTE</th></tr></thead>
            <tbody>
              <tr><td>25/03/2024</td><td>Teclado</td><td><span class="status rejected">Rechazado</span></td><td>$70,999</td></tr>
              <tr><td>25/03/2024</td><td>Accesorios</td><td><span class="status approved">Aprobado</span></td><td>$83,348</td></tr>
            </tbody>
          </table>
        </div>
        <div class="card analysis-report-card">
          <h3>Informe de análisis</h3>
          <div class="analysis-content">
            <div class="analysis-item"><p>Crecimiento de finanzas</p><span class="value positive">+45.14%</span></div>
            <div class="analysis-item"><p>Ratio de gastos</p><span class="value">0.58%</span></div>
            <div class="analysis-item"><p>Riesgo empresarial</p><span class="value status-low">Bajo</span></div>
          </div>
          <div class="chart-canvas-container analysis-chart-container"><canvas id="companyFinanceChart"></canvas></div>
        </div>
      </section>

      <section class="grid-row bottom-row">
        <div class="card sales-report-card">
          <div class="chart-header"><h3>Informe de ventas</h3>
            <div class="chart-controls text-style"><button>Hoy</button><button>Semana</button><button>Mes</button><button class="active">Año</button></div>
          </div>
          <p class="net-benefit">Beneficio neto</p><p class="net-benefit-amount">$230,000</p>
          <div class="chart-canvas-container"><canvas id="salesReportChart"></canvas></div>
        </div>
        <div class="card transaction-history-card">
          <h3>Historial de transacciones</h3>
          <div class="transaction-list">
            <div class="transaction-item"><div class="transaction-icon green-bg"><span>+</span></div><div><p>Pedido #002434</p><small>Hoy, 2:00 AM</small></div><div><span class="amount positive">+ $1,430</span></div></div>
            <div class="transaction-item"><div class="transaction-icon blue-bg"><span>+</span></div><div><p>Pedido #984947</p><small>5 Ago, 13:45</small></div><div><span class="amount positive">+ $302</span></div></div>
          </div>
        </div>
        <div class="card chat-support-card">
          <div class="chat-avatars"><img src="https://i.pravatar.cc/35?img=1"><img src="https://i.pravatar.cc/35?img=2"><img src="https://i.pravatar.cc/35?img=3"></div>
          <p>Repetición típica en 5 minutos</p><button class="help-button">¿Necesitas ayuda?</button>
        </div>
      </section>
    </div>
  </main>

  <script>
    lucide.createIcons();
    document.addEventListener('DOMContentLoaded', function(){
      const opts={responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},interaction:{mode:'index',intersect:false}};
      const uctx=document.getElementById('uniqueVisitorChart')?.getContext('2d');
      if(uctx){
        const data={mes:{labels:['Ene','Feb','Mar'],visits:[100,150,100],sessions:[80,120,80]},semana:{labels:['Lun','Mar','Mié'],visits:[40,85,60],sessions:[30,65,40]}};
        const chart=new Chart(uctx,{type:'line',data:{labels:data.mes.labels,datasets:[{label:'Visitas',data:data.mes.visits,borderColor:'#007bff',backgroundColor:'rgba(0,123,255,0.1)',fill:true},{label:'Sesiones',data:data.mes.sessions,borderColor:'#6c757d',backgroundColor:'rgba(108,117,125,0.1)',fill:true}]},options:opts});
        document.querySelectorAll('.unique-visitor-card button').forEach(btn=>btn.addEventListener('click',function(){document.querySelector('.unique-visitor-card .active').classList.remove('active');this.classList.add('active');const d=data[this.textContent.toLowerCase()];chart.data.labels=d.labels;chart.data.datasets[0].data=d.visits;chart.data.datasets[1].data=d.sessions;chart.update()}));
      }
      const wctx=document.getElementById('weeklyIncomeChart')?.getContext('2d');
      if(wctx){new Chart(wctx,{type:'bar',data:{labels:['L','M','M','J','V','S','D'],datasets:[{data:[100,130,180,90,50,110,150],backgroundColor:'#48d8b2',borderRadius:4}]},options:opts});}
      const cctx=document.getElementById('companyFinanceChart')?.getContext('2d');
      if(cctx){new Chart(cctx,{type:'line',data:{labels:['Jun','Jul','Ago'],datasets:[{data:[130,80,150],borderColor:'#ffc107',backgroundColor:'rgba(255,193,7,0.1)',fill:true}]},options:opts});}
      const sctx=document.getElementById('salesReportChart')?.getContext('2d');
      if(sctx){
        const d={hoy:{labels:['Mañana','Tarde'],income:[1200,1900],cost:[400,600],net:'$2,500'},año:{labels:['Q1','Q2','Q3','Q4'],income:[120000,150000,110000,180000],cost:[50000,60000,45000,75000],net:'$230,000'}};
        const chart=new Chart(sctx,{type:'bar',data:{labels:d.año.labels,datasets:[{label:'Ingreso',data:d.año.income,backgroundColor:'#FFC107',borderRadius:4},{label:'Costo',data:d.año.cost,backgroundColor:'#007bff',borderRadius:4}]},options:opts});
        const controls=document.querySelectorAll('.sales-report-card button');const netEl=document.querySelector('.net-benefit-amount');
        controls.forEach(btn=>btn.addEventListener('click',function(){controls.forEach(b=>b.classList.remove('active'));this.classList.add('active');const period=this.textContent.toLowerCase();const nd=d[period];chart.data.labels=nd.labels;chart.data.datasets[0].data=nd.income;chart.data.datasets[1].data=nd.cost;chart.update();netEl.textContent=nd.net;}));
      }
    });
  </script>
<script src="/js/sessionCheck.js"></script>
</body>
</html>
