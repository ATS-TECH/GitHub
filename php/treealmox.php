
   <!-- Navbar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <div class="container">
           <ul role="navigation" class="nav navbar-left" style="margin-right: 2rem;">
                <li class="dropdown" style="margin-top:15px;text-decoration: none;">
                    <button data-toggle="dropdown" class="dropdown-toggle" type="button" >ALMOXARIFADO</button>
                    <ul class="dropdown-menu dropdown-menu-right">
    <?php
        $link1='php/novafamilia.php?idpessoa='.$_REQUEST['idpessoa'] ;
        include 'mysql.php';
         
        $cmd1 = "select * from componente where idpessoa=".$_REQUEST['idpessoa'] ;
        
        $cmd1=  mysql_query($cmd1);
        echo mysql_error();
        while($rs1=  mysql_fetch_array($cmd1))
        {
            echo '<li><button type="button" class="btn btn-xs badge "  '
            . 'id=btcomp onclick="mostrafamilia('.$rs1["idcomponente"].');"  width="100%" >'.$rs1["descrComponente"].'</button></li>';
        
            
        }
    ?>
                    </ul>
            </li>
        </ul>  
    </div>

  </div>


</nav>
