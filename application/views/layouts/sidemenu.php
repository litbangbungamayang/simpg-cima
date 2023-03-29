
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <?php
 $mod = $this->uri->segment(1);
?>
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('logo.png');?>" id="imglogo" class="img-circle" style="height:40px" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=$this->session->userdata('fid');?></p>
              <a href="#"><?=CNF_PLANCODE;?> <?=CNF_PG;?></a>
            </div>
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>

            <?php $sidebar = SiteHelpers::menus('sidebar');?>
<?php foreach ($sidebar as $menu) : ?>
   <li class="treeview <?php if($menu['module'] == $mod) echo 'active';?>">
   
    <a 
      <?php 
      if($menu['menu_type'] =='external') { 
        echo 'href="'.$menu['url'].'"';  
      } else {
        echo 'href="'.site_url($menu['module']).'"';
      }
      ?>  
          
    
     <?php  if(count($menu['childs']) > 0 ) echo 'class="expand level-closed"';?>>
      <i class="<?php echo $menu['menu_icons'];?>"></i> <span class="nav-label">

      <?php 

        if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][$this->session->userdata('lang')])):
          echo  $menu['menu_lang']['title'][$this->session->userdata('lang')] ;
        else:
          echo $menu['menu_name'];
        endif;
      ?>    

        
      </span><i class="fa fa-angle-left pull-right"></i> 
    </a> 
    <?php if(count($menu['childs']) > 0) :?>
      <ul class="treeview-menu">
        <?php foreach ($menu['childs'] as $menu2) : ?>
         <li class="<?php if($menu2['module'] == $mod) echo 'active';?>">
          <a 
            <?php 
            if($menu2['menu_type'] =='external') {  
              echo 'href="'.$menu2['url'].'"';  
            } else {
              echo 'href="'.site_url($menu2['module']).'"';
            }
            ?>                  
          > <i class="fa fa-circle-o"></i>  
          <?php 
          
            if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][$this->session->userdata('lang')])):
              echo  $menu2['menu_lang']['title'][$this->session->userdata('lang')] ;
            else:
              echo $menu2['menu_name'];
            endif;
          ?>            
          
          </a> 
          <?php if(count($menu2['childs']) > 0) : ?>
          <ul class="treeview-menu">
            <?php foreach($menu2['childs'] as $menu3) : ?>
              <li>
                <a 
                  <?php 
                  if($menu3['menu_type'] =='external') {  
                    echo 'href="'.$menu3['url'].'"';  
                  } else {
                    echo 'href="'.site_url($menu3['module']).'"';
                  }
                  ?>                                
                > <i class="<?php echo $menu3['menu_icons'];?>"></i>  
                <?php 
                
                  if(CNF_MULTILANG ==1 && isset($menu3['menu_lang']['title'][$this->session->userdata('lang')])):
                    echo  $menu3['menu_lang']['title'][$this->session->userdata('lang')] ;
                  else:
                    echo $menu3['menu_name'];
                  endif;
                ?>                                    
                
                </a>
              </li> 
            <?php endforeach;?>
          </ul>
          <?php endif;?>              
        </li>             
        <?php endforeach;?>
      </ul>
    <?php endif;?>
  </li>
<?php endforeach;?>   
<?php
  if(CNF_METODE == '2' && CNF_COMPANYCODE == 'N007' && $this->session->userdata('gid') == 6){
    ?>
    <li class="treeview ">
   
    <a href="<?php echo site_url('tanalisarendemen/indexevaluasi');?>">
      <i class="fa fa-building-o"></i> <span class="nav-label">
      Upload Evaluasi ARI
      </span><i class="fa fa-angle-left pull-right"></i> 
    </a> 
      </li>
    <?php
  }
?>

            <!--li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="../widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li class="active"><a href="data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="../calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="../mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

<script type="text/javascript">
  $(document).ready(function(){
      $( "li.active" ).parent("ul.treeview-menu").parent( "li.treeview" ).addClass("active" );
  });
</script>