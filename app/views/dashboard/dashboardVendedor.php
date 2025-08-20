<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel de Control - Ventas</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    :root { --primary-color:#7f56d9;--primary-light:#f3f4f6;--text-dark:#111827;--text-light:#6b7280;--body-bg:#f9fafb;--card-bg:#fff;--border-color:#e5e7eb;--success-color:#10b981;--danger-color:#ef4444;}
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'Inter',sans-serif;background:var(--body-bg);color:var(--text-dark);}
    .main{width:100%;padding:25px 30px;overflow-y:auto;background:#f9fafb;}
    .header{display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;}
    .header h1{font-size:1.8em;font-weight:600;}
    .header-search-container{background:#fff;border-radius:22px;padding:5px;box-shadow:0 1px 3px rgba(0,0,0,0.07);display:flex;align-items:center;width:280px;}
    .header-search-container .input-icon.header-search{display:flex;align-items:center;flex-grow:1;padding:5px 10px;gap:8px;}
    .header-search-container .input-icon.header-search i{color:#9ca3af;flex-shrink:0;}
    .header-search-container .input-icon.header-search input{border:none;flex-grow:1;font-size:.9em;outline:none;background:transparent;color:#111827;}
    .header-search-container:hover .input-icon.header-search i,.header-search-container:hover .input-icon.header-search input::placeholder{color:#7f56d9;}
    .dashboard-content{display:flex;flex-direction:column;gap:24px;}
    .card{background:var(--card-bg);padding:25px;border-radius:16px;display:flex;flex-direction:column;box-shadow:0 4px 10px rgba(0,0,0,0.05);transition:transform .3s ease,box-shadow .3s ease;}
    .card:hover{transform:translateY(-5px);box-shadow:0 8px 20px rgba(0,0,0,0.08);}
    .grid-row{display:grid;gap:24px;}
    .top-row{grid-template-columns:2.5fr 1fr;}
    .middle-row{grid-template-columns:2.5fr 1fr;}
    .overview-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px;}
    .overview-cards .card{background:#111;color:#fff;justify-content:center;align-items:center;gap:15px;text-align:center;}
    .overview-cards .card i{background:#333;color:#fff;padding:12px;border-radius:50%;display:flex;align-items:center;justify-content:center;stroke-width:2;}
    .overview-cards .card h3{color:#ccc;font-size:.9em;font-weight:500;margin:0;}
    .overview-cards .card p{font-size:1.8em;font-weight:600;color:#fff;margin:0;line-height:1.2;}
    .overview-cards .card .percentage{font-size:.8em;font-weight:500;margin-left:8px;vertical-align:baseline;}
    .percentage.positive{color:var(--success-color);}
    .percentage.neutral{color:var(--danger-color);}
    .chart-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
    .chart-header h3{margin:0;font-size:1.2em;font-weight:600;}
    .chart-controls button{border:1px solid var(--border-color);background:#fff;padding:8px 18px;margin-left:5px;border-radius:10px;cursor:pointer;font-size:.9em;font-weight:500;transition:all .2s ease;}
    .chart-controls button.active{background:var(--primary-color);color:#fff;border-color:var(--primary-color);}
    .chart-canvas-container{flex-grow:1;position:relative;min-height:250px;}
    .orders-summary-card .income-chart-container{min-height:150px;}
    .category-sales-card .analysis-chart-container{height:auto;}
    .table-wrapper{overflow-x:auto;}
    .recent-orders-card table{width:100%;border-collapse:collapse;}
    .recent-orders-card th,.recent-orders-card td{padding:16px 14px;font-size:.9em;border-bottom:1px solid var(--primary-light);}
    .recent-orders-card th{text-align:left;color:var(--text-light);font-weight:600;}
    .status{padding:5px 12px;border-radius:9999px;font-size:.8em;font-weight:600;}
    .status.approved{background:#d1fae5;color:#065f46;}
    .status.rejected{background:#fee2e2;color:#991b1b;}
    .status.pending{background:#fef3c7;color:#92400e;}
    @media(max-width:1200px){.top-row,.middle-row{grid-template-columns:1fr}.overview-cards{grid-template-columns:repeat(2,1fr)}}
    @media(max-width:768px){.header{flex-direction:column;align-items:flex-start;gap:15px}.header-search-container{width:100%}.overview-cards{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <main class="main">
    <header class="header">
      <h1>Hola, Brayan 👋</h1>
      <div class="header-search-container">
        <div class="input-icon header-search"><i data-lucide="search"></i><input type="text" placeholder="Buscar..."/></div>
      </div>
    </header>
    <div class="dashboard-content">
      <section class="overview-cards">
        <div class="card"><i data-lucide="dollar-sign"></i><div><h3>Ingresos Totales</h3><p>$12,450 <span class="percentage positive">+15.2%</span></p></div></div>
        <div class="card"><i data-lucide="shopping-cart"></i><div><h3>Pedidos Realizados</h3><p>350 <span class="percentage positive">+21.0%</span></p></div></div>
        <div class="card"><i data-lucide="user-plus"></i><div><h3>Nuevos Clientes</h3><p>82 <span class="percentage neutral">+5.4%</span></p></div></div>
        <div class="card"><i data-lucide="activity"></i><div><h3>Tasa de Conversión</h3><p>4.25% <span class="percentage positive">+1.5%</span></p></div></div>
      </section>
      <section class="grid-row top-row">
        <div class="card revenue-summary-card">
          <div class="chart-header"><h3>Resumen de Ingresos</h3><div class="chart-controls"><button class="active">Mes</button><button>Semana</button></div></div>
          <div class="chart-canvas-container"><canvas id="revenueChart"></canvas></div>
        </div>
        <div class="card orders-summary-card"><h3>Pedidos por Día (Semana)</h3><div class="chart-canvas-container income-chart-container"><canvas id="dailyOrdersChart"></canvas></div></div>
      </section>
      <section class="grid-row middle-row">
        <div class="card recent-orders-card">
          <h3>Pedidos Recientes</h3>
          <div class="table-wrapper">
            <table>
              <thead><tr><th>NÚMERO DE SEGUIMIENTO</th><th>PRODUCTO</th><th>ESTADO</th><th>IMPORTE</th></tr></thead>
              <tbody>
                <tr><td>25/03/2024</td><td>Teclado</td><td><span class="status rejected">Rechazado</span></td><td>$70,999</td></tr>
                <tr><td>25/03/2024</td><td>Accesorios</td><td><span class="status approved">Aprobado</span></td><td>$83,348</td></tr>
                <tr><td>26/03/2024</td><td>Lente de cámara</td><td><span class="status rejected">Rechazado</span></td><td>$40,570</td></tr>
                <tr><td>26/03/2024</td><td>TELEVISOR</td><td><span class="status pending">Pendiente</span></td><td>$410,780</td></tr>
                <tr><td>26/03/2024</td><td>Auricular</td><td><span class="status approved">Aprobado</span></td><td>$10,239</td></tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card category-sales-card"><h3>Ventas por Categoría</h3><div class="chart-canvas-container analysis-chart-container"><canvas id="categorySalesChart"></canvas></div></div>
      </section>
    </div>
  </main>
  <script>
    lucide.createIcons();
    document.addEventListener('DOMContentLoaded',function(){
      const commonChartOptions={responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},interaction:{mode:'index',intersect:false},scales:{x:{grid:{display:false}},y:{beginAtZero:true,ticks:{callback:v=>v>=1000?'$'+v/1000+'k':'$'+v}}}};
      const revenueCtx=document.getElementById('revenueChart')?.getContext('2d');
      if(revenueCtx){const revenueData={mes:{labels:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],ingresos:[1500,2200,1800,2500,2300,2800,3000,2600,3200,3500,3100,4000],ganancias:[500,900,700,1100,950,1300,1400,1100,1500,1700,1450,2000]},semana:{labels:['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'],ingresos:[400,850,600,950,550,1000,1150],ganancias:[150,350,250,400,200,450,500]}};const revenueChart=new Chart(revenueCtx,{type:'line',data:{labels:revenueData.mes.labels,datasets:[{label:'Ingresos',data:revenueData.mes.ingresos,borderColor:'#7f56d9',backgroundColor:'rgba(127,86,217,0.1)',fill:true,tension:.4},{label:'Ganancias',data:revenueData.mes.ganancias,borderColor:'#6c757d',backgroundColor:'rgba(108,117,125,0.1)',fill:true,tension:.4}]},options:commonChartOptions});document.querySelectorAll('.revenue-summary-card .chart-controls button').forEach(btn=>{btn.addEventListener('click',function(){document.querySelector('.revenue-summary-card .chart-controls .active').classList.remove('active');this.classList.add('active');const period=this.textContent.toLowerCase();const data=revenueData[period];revenueChart.data.labels=data.labels;revenueChart.data.datasets[0].data=data.ingresos;revenueChart.data.datasets[1].data=data.ganancias;revenueChart.update();});});}
      const dailyOrdersCtx=document.getElementById('dailyOrdersChart')?.getContext('2d');
      if(dailyOrdersCtx){new Chart(dailyOrdersCtx,{type:'bar',data:{labels:['L','M','M','J','V','S','D'],datasets:[{label:'Pedidos',data:[40,55,62,45,70,85,90],backgroundColor:'#48d8b2',borderRadius:4}]},options:{...commonChartOptions,scales:{x:{grid:{display:false}},y:{display:false}}}});}
      const categorySalesCtx=document.getElementById('categorySalesChart')?.getContext('2d');
      if(categorySalesCtx){new Chart(categorySalesCtx,{type:'doughnut',data:{labels:['Electrónicos','Ropa','Hogar','Accesorios'],datasets:[{label:'Ventas',data:[12500,8500,6200,4300],backgroundColor:['#7f56d9','#ffc107','#48d8b2','#6c757d'],hoverOffset:4}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom'}}}});}
    });
  </script>
</body>
<script src="/js/sessionCheck.js"></script>
</html>
