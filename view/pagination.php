<?php
	$previous = "";
    if($page <= 1){
        $previous = "<li class='page-item disabled'>
                        <a class='page-link' href='#' aria-label='Previous'>
                            <span aria-hidden='true'>&laquo;</span>
                            <span class='sr-only'>Previous</span>
                        </a>
                    </li>";
    }else{
        $previous = "<li class='page-item'>
                        <a class='page-link' href='".$url."master-user.php?page=".($page-1)."' aria-label='Previous'>
                            <span aria-hidden='true'>&laquo;</span>
                            <span class='sr-only'>Previous</span>
                        </a>
                    </li>";
    }

    $next = "";
    if ($page == $total_page) {
        $next = "<li class='page-item disabled'>
                    <a class='page-link' href='#' aria-label='Next'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>
                    </a>
                </li></ul></div>";
    }else{
        $next = "<li class='page-item'>
                    <a class='page-link' href='".$url."master-user.php?page=".($page+1)."' aria-label='Next'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>
                    </a>
                </li></ul></div>";
    }

    $page_link = "<div><ul class='pagination'>".$previous;
       

    for($i = 1; $i <= $total_page; $i++){
        $active = "";
        if($page == $i){
            $active = "active";
        }
        $page_link .= "<li class='page-item ".$active."'><a class='page-link' href='".$url."master-user.php?page=".$i."'>".$i."</a></li>";
    }
    echo $page_link.$next;
?>