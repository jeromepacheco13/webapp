<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| LAVALust - a lightweight PHP MVC Framework is free software:
| -------------------------------------------------------------------   
| you can redistribute it and/or modify it under the terms of the
| GNU General Public License as published
| by the Free Software Foundation, either version 3 of the License,
| or (at your option) any later version.
|
| LAVALust - a lightweight PHP MVC Framework is distributed in the hope
| that it will be useful, but WITHOUT ANY WARRANTY;
| without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
|
| You should have received a copy of the GNU General Public License
| along with LAVALust - a lightweight PHP MVC Framework.
| If not, see <https://www.gnu.org/licenses/>.
|
| @author       Ronald M. Marasigan
| @copyright    Copyright (c) 2020, LAVALust - a lightweight PHP Framework
| @license      https://www.gnu.org/licenses
| GNU General Public License V3.0
| @link     https://github.com/BABAERON/LAVALust-MVC-Framework
|
*/

/*
* ------------------------------------------------------
*  Class Pagination
* ------------------------------------------------------
*/
class Pagination {
	
	public function renderbootstrap($page, $total, $url) {
		/*How many records you want to show in a single page.*/
		$limit = 1;
		/*How may adjacent page links should be shown on each side of the current page link.*/
		$adjacents = 1;
		/*Get total number of records */
		$total_rows = $total;
		/*Get the total number of pages.*/
		$total_pages = ceil($total_rows / $limit);
		
		//$page = $_GET['page'];
		if($page != "") {
			$page = $page;
			$offset = $limit * ($page-1);
		} else {
			$page = 1;
			$offset = 0;
		}
		
		//Checking if the adjacent plus current page number is less than the total page number.
		//If small then page link start showing from page 1 to upto last page.
		if($total_pages <= (1+($adjacents * 2))) {
			$start = 1;
			$end   = $total_pages;
		} else {
			if(($page - $adjacents) > 1) {				   //Checking if the current page minus adjacent is greateer than one.
				if(($page + $adjacents) < $total_pages) {  //Checking if current page plus adjacents is less than total pages.
					$start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
					$end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
				} else {								   //If current page plus adjacents is greater than total pages.
					$start = ($total_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
					$end   = $total_pages;						   //and the end will be the last page number that is total pages number.
				}
			} else {									   //If the current page minus adjacent is less than one.
				$start = 1;                                //then start will be start from page number 1
				$end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
			}
		}
		//If you want to display all page links in the pagination then
		//uncomment the following two lines
		//and comment out the whole if condition just above it.
		/*$start = 1;
		$end = $total_pages;*/
		
		if($total_pages >= 1) { ?>
			<div class="pagination alternate pull-right">
				<ul>
					<!-- Link of the first page -->
					<li class='<?php ($page <= 1 ? print 'disabled' : '')?>'>
						<a href='<?php print $url;?>/1'>First</a>
					</li>
					<!-- Link of the previous page -->
					<li class='<?php ($page <= 1 ? print 'disabled' : '')?>'>
						<a href='<?php print $url;?>/<?php ($page>1 ? print($page-1) : print 1)?>'>Previous</a>
					</li>
					<!-- Links of the pages with page number -->
					<?php for($i=$start; $i<=$end; $i++) { ?>
					<li class='<?php ($i == $page ? print 'active' : '')?>'>
						<a href='<?php print $url;?>/<?php echo $i;?>'><?php echo $i;?></a>
					</li>
					<?php } ?>
					<!-- Link of the next page -->
					<li class='<?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						<a href='<?php print $url;?>/<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>Next</a>
					</li>
					<!-- Link of the last page -->
					<li class='<?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						<a href='<?php print $url;?>/<?php echo $total_pages;?>'>Last</a>
					</li>
				</ul>
			</div>
		<?php }
	}
}