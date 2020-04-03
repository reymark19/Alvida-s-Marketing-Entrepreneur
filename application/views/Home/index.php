
      <div class="android-content mdl-layout__content">
        <a></a>
        <div class="carousel-container">
        	<?php foreach ($banners as $banner): ?>
		        <div class="banner android-be-together-section mdl-typography--text-left" style="background: url('<?php echo $banner["Path"] ?>') center 30% no-repeat;background-size: cover;">
		          <div class="logo-font android-slogan"><span><?php echo $banner["BannerName"] ?></span></div>
		          <?php if ($banner["Description"] != "" && $banner["Description"] != " " && $banner["Description"] != null): ?>
		          <div class="logo-font android-sub-slogan"><span><?php echo $banner["Description"] ?></span></div>
		          <?php endif ?>
		          <br>
		          <br>
		          <?php if ($banner["ActionId"] == 1): ?>
		          	<a href="#!" style="margin-left: 15px;" target="_blank" class="button-l mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast btn-give-now">Give Now</a>
		          <?php endif ?>
		          
		        </div>
	        <?php endforeach ?>
        </div>
        
        

		<div class="separator"></div>

        <div class="android-screen-section mdl-typography--text-center no-padding-bottom">
          <div class="mdl-typography--font-light mdl-typography--display-3 bolder">Youth. Our <span class="text-dark-yellow">Mission</span>. Our Passion.</div>

			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--2-col"></div>
				<div class="mdl-cell mdl-cell--8-col">
					<p class="mdl-typography--headline mdl-typography">
		                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		          </p>
				</div>
				<div class="mdl-cell mdl-cell--2-col"></div>
			</div>
        </div>

        <div class="android-more-section no-padding">
          <div class="android-card-container mdl-grid">

          	<?php foreach ($missions as $mission): ?>
          		<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
	              <div class="mdl-card__media mdl-card__media-orig">
	                <img src="<?php echo $mission['Path'] ?>">
	              </div>
	              <div class="mdl-card__title">
	                 <h4 class="mdl-card__title-text bold"><?php echo $mission['MissionName'] ?></h4>
	              </div>
	              <div class="mdl-card__supporting-text orig-hide title-con">
	                <span class="mdl-typography--font-light mdl-typography--subhead">Four tips to make your switch to Android quick and easy</span>
	              </div>
	              <div class="mdl-card__actions orig-hide">
	                 <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase text-blue" href="<?php echo base_url() ?>OurMission#<?php echo str_replace(' ', '', $mission['MissionName']); ?>">
	                   Learn More
	                   <i class="material-icons">chevron_right</i>
	                 </a>
	              </div>
	            </div>
          	<?php endforeach ?>
            

          </div>
        </div>

		<div class="separator"></div>
        <video width="100%" src="<?php echo base_url() ?>upload/SDBVocationPromotion.mp4" muted autoplay></video>

        <div class="android-more-section no-padding no-max-width yellow-dark-background">
        	<div class="slider">
			  <div class="slides">
			  	<?php $swipeCnt = 0; for ($i=1; $i <= ceil(count($campaigns)/4); $i++) { 
	        		$missionCnt = 0;
	        		$swipeCnt++;

	        		?>
	        		<div id="slide6-<?php echo $i; ?>"  class="android-card-container mdl-grid">
		          	<?php foreach ($campaigns as $mission): ?>
		          		<?php 
		          			$missionCnt++;
		          			if (ceil($missionCnt/4) == $i) {
		          		 ?>
		          		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--3dp">
			              <div class="mdl-card__media">
			                <img src="<?php echo $mission['Path'] ?>">
			              </div>
			              <div class="mdl-card__title orig-hide">
			                 <h4 class="mdl-card__title-text bold"><?php echo $mission['CampaignName'] ?></h4>
			              </div>
			              <div class="mdl-card__supporting-text text-left orig-hide">
			                <span class="mdl-typography--font-light mdl-typography--subhead card-overflow-50"><?php echo $mission['Description'] ?></span>
			              </div>
			              <div class="mdl-card__actions text-left position-unset bg-yellow">
			                 <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase text-blue white-give-now" href="<?php echo base_url() ?>Give">
			                   Give Now
			                   <i class="material-icons">chevron_right</i>
			                 </a>
			              </div>
			            </div>
			            <?php } ?>
		          	<?php endforeach ?>
		          	</div>
	        	<?php } ?>
			  </div>
				<?php $swipeCnt = 0; for ($i=1; $i <= ceil(count($campaigns)/4); $i++) { 
				$missionCnt = 0;
				$swipeCnt++;
				$isactive = 'is-active';
					if ($i != 1) {
						$isactive = '';
					}
				?>
				<a href="#slide6-<?php echo $i; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect no-min-width mdl-button--accent" style="background-color: #2e3181">
				  <?php echo $i ?>
				</a>
				<?php } ?>
			  <a href="#slider" class=""></a>
			  <br><br>
			</div>
	    </div>


        <div class="yellow-dark-background text-center">
        	<a href="<?php echo base_url() ?>OurMission" class="button-m mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast btn-sign-up orig-text-blue btn-view-all">View All</a>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript">
	      google.charts.load('current', {
	        'packages':['geochart'],
	        // Note: you will need to get a mapsApiKey for your project.
	        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
	        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
	      });
	      google.charts.setOnLoadCallback(drawRegionsMap);

	      function drawRegionsMap() {
	        var data = google.visualization.arrayToDataTable([
	          ['Country', 'Houses'],
	          ['Philippines', 14],
	          ['Pakistan', 2]
	        ]);
	        var options = {
	        	region: '142',
		        colorAxis: {colors: ['darkblue', 'darkblue']}
	        };

	        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

	        chart.draw(data, options);
	      }
	    </script>
	    <div class="mdl-grid">
		  <div class="mdl-cell mdl-cell--4-col">
		  	<div class="mdl-typography--font-light mdl-typography--display-3 bolder">Our mission work in <span class="text-blue">16</span> houses</div>

			<div class="separator"></div>
		  	<div class="mdl-typography--font-light">
		  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		  		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		  		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		  		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		  	</div>
		  </div>
		  <div class="mdl-cell mdl-cell--8-col">
		  	<div id="regions_div" style="width: 100%; height: 500px;"></div>
		  </div>
		</div>
    

<script src="<?php echo base_url() ?>js/Home/index.js"></script>