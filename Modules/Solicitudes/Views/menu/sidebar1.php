<style>
    ul.acorh,
    ul.acorh * {
    margin: 0;
    padding: 0;
    border: 0;
    }
    ul.acorh {
    margin: 10px auto;
    padding: 0;
    list-style: none;
    width: 100%;
    font-size: 18px;
    }
    ul.acorh li {
    list-style: none;
    }
    ul.acorh li a {
    display: block;
    padding: 10px 10px 10px 20px;
    background: #333;
    color: #eee;
    border-bottom: 1px solid #000;
    border-top: 1px solid #666;
    text-decoration: none;
    box-sizing: border-box;
    }
    ul.acorh li ul {
    max-height: 0;
    margin: 0;
    padding: 0;
    list-style: none;
    overflow: hidden;
    transition: .3s all ease-in;
    }
    ul.acorh li li a {
    padding: 10px 10px 10px 40px;
    background: #999;
    color: #000;
    font-size: 16px;
    border: 0;
    border-bottom: 1px solid #ccc;
    box-sizing: border-box;
    }
    ul.acorc li li:last-child a {
    border-bottom: 0;
    }
    ul.acorh li:hover ul {
    max-height: 300px;
    transition: .3s all ease-in;
    }
    ul.acorh li a:hover {
    background: #666;
    color: #fff;
    }
</style>

<ul class=»acorh»>
<li><a href=»#»>OPCIÓN 1</a>
<ul>
<li><a href=»URL11″>Opción 1.1</a></li>
<li><a href=»URL12″>Opción 1.2</a></li>
</ul>
</li>
<li><a href=»#»>OPCIÓN 2</a>
<ul>
<li><a href=»URL21″>Opción 2.1</a></li>
<li><a href=»URL22″>Opción 2.2</a></li>
<li><a href=»URL23″>Opción 2.3</a></li>
</ul>
</li>
<li><a href=»#»>OPCIÓN 3</a>
<ul>
<li><a href=»URL31″>Opción 3.1</a></li>
<li><a href=»URL32″>Opción 3.2</a></li>
</ul>
</li>
</ul>