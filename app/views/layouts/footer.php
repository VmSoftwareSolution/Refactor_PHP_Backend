<style>
  footer {
    background: #000;
    color: #fff;
    padding: 3rem 2rem 1rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
  }

  .footer-col h4 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-weight: bold;
    border-left: 3px solid #9333ea;
    padding-left: .5rem;
  }

  .footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-col ul li {
    margin-bottom: .5rem;
  }

  .footer-col ul li a {
    text-decoration: none;
    color: #ccc;
    transition: .3s;
  }

  .footer-col ul li a:hover {
    color: #fff;
  }

  .footer-socials {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
  }

  .footer-socials a {
    display: inline-block;
    background: #9333ea;
    color: #fff;
    padding: .5rem;
    border-radius: 50%;
    font-size: .9rem;
    text-align: center;
    transition: .3s;
  }

  .footer-socials a:hover {
    background: #fff;
    color: #9333ea;
  }

  .footer-bottom {
    text-align: center;
    border-top: 1px solid #333;
    padding-top: 1rem;
    font-size: .9rem;
    color: #aaa;
  }
</style>

<footer>
  <div class="footer-container">
    <div class="footer-col">
      <h4>Shop</h4>
      <ul>
        <li><a href="#">Flash Sales</a></li>
        <li><a href="#">New Arrivals</a></li>
        <li><a href="#">Best Sellers</a></li>
        <li><a href="#">Explore</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Help</h4>
      <ul>
        <li><a href="#">Customer Service</a></li>
        <li><a href="#">Returns</a></li>
        <li><a href="#">Order Tracking</a></li>
        <li><a href="#">FAQs</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Company</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Press</a></li>
        <li><a href="#">Affiliate</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Follow Us</h4>
      <div class="footer-socials">
        <a href="#">F</a>
        <a href="#">T</a>
        <a href="#">I</a>
        <a href="#">Y</a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    © 2025 TuTienda. All Rights Reserved.
  </div>
</footer>
