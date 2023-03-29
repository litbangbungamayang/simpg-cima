			<style type="text/css">
				a{
					color: #333;
				}
				a:focus{
					text-decoration: none;
				}
				.list-group-item {
				    border: 1px solid rgba(0,0,0,.125);
				}
			</style>
			<div class="tab2">
			  <button class="tablinks2 active" onclick="openDashboard(event, 'belum')">Belum Selektor</button>
			  <button class="tablinks2" onclick="openDashboard(event, 'sudah')">Sudah Selektor</button>
			</div>
			<!-- Tab content -->
			<div id="belum" class="tabcontent2 active"  style="display: block;padding-top: 45px;padding-bottom: 68px;">
				<ul class="list-group">
				  <li class="list-group-item">
				  	<div style="font-weight: bold;">Semboro 3,472 Ha</div>
				  	<div style="font-size: 13px;color: red;">KP11-17-0200012</div>
				  	<div style="font-size: 13px;">Bulan Tanam 78 Kondisi Areal RHL Varietas BLL</div>	
				  </li>
				  <li class="list-group-item"  style="padding-top: 45px;padding-bottom: 68px;">
				  	<div style="font-weight: bold;">Semboro 3,472 Ha</div>
				  	<div style="font-size: 13px;color: red;">KP11-17-0200012</div>
				  	<div style="font-size: 13px;">Bulan Tanam 78 Kondisi Areal RHL Varietas BLL</div>	
				  </li>
				</ul>
			</div>
			<div id="sudah" class="tabcontent2">
			</div>
			<script type="text/javascript">
				function openDashboard(evt, cityName) {
				  // Declare all variables
				  var i, tabcontent2, tablinks2;

				  // Get all elements with class="tabcontent2" and hide them
				  tabcontent2 = document.getElementsByClassName("tabcontent2");
				  for (i = 0; i < tabcontent2.length; i++) {
				    tabcontent2[i].style.display = "none";
				  }

				  // Get all elements with class="tablinks2" and remove the class "active"
				  tablinks2 = document.getElementsByClassName("tablinks2");
				  for (i = 0; i < tablinks2.length; i++) {
				    tablinks2[i].className = tablinks2[i].className.replace(" active", "");
				  }

				  // Show the current tab, and add an "active" class to the button that opened the tab
				  document.getElementById(cityName).style.display = "block";
				  evt.currentTarget.className += " active";
				}
			</script>
		