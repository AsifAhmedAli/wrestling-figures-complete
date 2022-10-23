<?php
include("./db.php");
$current_page = $_POST['current_page'];
            //   $result->close();
            //   $conn->next_result();
            if(isset($_POST['filter'])){
                    // $total_wrestling_figures = $_POST['counter'];
                    // echo "<script>console.log('".$total_wrestling_figures."')</script>";
                    // $total_pages = ceil($total_wrestling_figures/20);
                    // echo "<script>console.log('".$total_pages."')</script>";
            }
            else{
                $sql = "CALL count_wrestling_figures()";
                $result = $conn->query($sql);
  
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    $total_wrestling_figures = $row['tid'];
                  }
                }
                $total_pages = ceil($total_wrestling_figures/20);
                
                ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                <?php 
                    $previous_page = $current_page - 1;
                    if($previous_page > 0){
                      ?>
                      <li class="page-item">
                        <a class="page-link" href="products.php?no=<?php echo $previous_page; ?>" aria-label="Previous">
                          <span class="material-icons">arrow_back_ios</span>
                        </a>  
                      </li>
                      <?php
                    }
                    ?>

                  <li class="page-item active"><a class="page-link"><?php echo $current_page ?></a></li>
                  <?php 
                    $next_page = $current_page + 1;
                    if($next_page <= $total_pages){
                      ?>
                    <li class="page-item">
                    <a class="page-link" href="products.php?no=<?php echo $next_page; ?>" aria-label="Next">
                      <span class="material-icons">arrow_forward_ios</span>
                    </a>
                  </li>
                      <?php
                    }
                    if($current_page > $total_pages || $current_page <= 0){
                      echo "<script>window.location.replace('./index.php')</script>";
                    }
                    ?>

                </ul>
              </nav>
              <div class="paging">Page  <?php echo $current_page." of ".$total_pages; ?></div>
              <?php
            }
              ?>
