<!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li <?php if (empty($_GET['page'])){ echo 'class="active"';}?>>
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
<!-------------PERULANGAN MENU ----------------------------------------------------------------------------------------------->					
                    <li <?php if((!empty($_GET['page']))and ($_GET['page']=='user')){ echo "class='active'";} ?>>
						<a href="index.php?page=user">
                            <i class="material-icons">text_fields</i>
                            <span>User</span>
                        </a>
                    </li>
<!----------------------------------------------------------------------------------------------------------------------------->
<!-------------PERULANGAN MENU ----------------------------------------------------------------------------------------------->					
                    <li <?php if((!empty($_GET['page']))and ($_GET['page']=='log')){ echo "class='active'";} ?>>
						<a href="index.php?page=log">
                            <i class="material-icons">text_fields</i>
                            <span>Log</span>
                        </a>
                    </li>
<!----------------------------------------------------------------------------------------------------------------------------->
<!-------------PERULANGAN MENU ----------------------------------------------------------------------------------------------->					
                    <li <?php if((!empty($_GET['page']))and ($_GET['page']=='card')){ echo "class='active'";} ?>>
						<a href="index.php?page=card">
                            <i class="material-icons">text_fields</i>
                            <span>Card</span>
                        </a>
                    </li>
<!----------------------------------------------------------------------------------------------------------------------------->
				
                    <li>
						<a href="logout.php">
                            <i class="material-icons">text_fields</i>
                            <span>Logout</span>
                        </a>
                    </li>					
                </ul>
            </div>