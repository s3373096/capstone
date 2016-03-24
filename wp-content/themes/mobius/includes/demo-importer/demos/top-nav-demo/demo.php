<?php
		
		$home_url = home_url();
		
		echo '<div class="to-import-demo-holder" data-name="top-nav-demo">';
			echo '<div class="to-import-demo-img">';
				echo '<img src="'.$path.'">';
				echo '<div class="to-import-demo-install">';
					echo '<div class="to-import-demo-install-inner"></div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="to-import-demo-overlay"></div>';
			echo '<span class="to-import-demo-details to-import-demo-import">'.__('Import Demo', 'to-importer-text-domain' ).'</span>';
			echo '<a href="'.$home_url.'" target="_blank"><span class="to-import-demo-details to-import-visit-site">'.__('Visit Site', 'to-importer-text-domain' ).'</span></a>';
			echo '<div class="to-import-demo-content">';			 
				echo '<h3 class="to-import-demo-name">Top Nav Demo</h3>';
				echo '<div class="to-import-demo-actions">';
					echo '<span class="to-demo-import-wait">'.__('Please Wait...', 'to-importer-text-domain' ).'</span><div class="spinner"></div>';echo '<a target="_blank" href="theme-one.com/mobius/" class="to-import-button to-import-demo-preview">'.__('Preview', 'to-importer-text-domain' ).'</a>';echo '<a class="to-import-button to-import-demo-import">'.__('Import', 'to-importer-text-domain' ).'</a>';
					echo '<a class="to-import-button to-import-demo-log">'.__('Log', 'to-importer-text-domain' ).'</a>';
					echo '<a class="to-import-button to-import-demo-visitesite" href="'.$home_url.'" target="_blank">'.__('Visit Site', 'to-importer-text-domain' ).'</a>';
					echo '<a class="to-import-button to-import-demo-reimport">'.__('Re-import', 'to-importer-text-domain' ).'</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';