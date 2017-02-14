            <div class="user-info">
                <div class="image">
				 <a href="index.php?page=profil">
                    <img src="images/<?php echo $_SESSION['name']; ?>.jpg" width="48" height="48" alt="User" />
				 </a>
                </div>
                <div class="info-container">
					<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					
							<?php echo $_SESSION['name']; ?>
					</div>
                    <div class="email"><?php echo $_SESSION['email']; ?></div>
                </div>
            </div>