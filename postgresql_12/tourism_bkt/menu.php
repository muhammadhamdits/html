sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              	  <p class="centered"><a href="index.php"><img src="icon/home.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo @$_SESSION['username'] ?></h5>

                  <li class="sub">
                      <a onclick="init();listTourism();" style="cursor:pointer;background:none"><i class="fa fa-list"></i>List Tourism</a>
                  </li>

                  <li class="sub">
                      <a onclick="" style="cursor:pointer;background:none"><i class="fa fa-thumb-tack"></i>Tourism Around You</a>
                      <ul class="treeview-menu">
                        <!-- <li style="margin-top:10px"><input id="inputradius" type="range" name="inputradius" data-highlight="true" min="1" max="10" value="1"></li>                             
                        <li><a onclick="init();tourism_sekitar_user();" style="cursor:pointer;background:none">Search</a></li> -->
                        <div class=" form-group" style="color: white;" > <!-- <br> -->
                          <!-- <label>Based On Radius</label><br> -->
                          <label for="inputradius" style="font-size: 10pt";>Radius : </label>
                          <label  id="nilai"  style="font-size: 10pt";>0</label> m
                          
                          <input  type="range" onchange="init();tourism_sekitar_user();cekkk();" id="inputradius" 
                                  name="inputradius" data-highlight="true" min="0" max="20" value="0" >
                          <script>
                            function cekkk()
                            {
                              document.getElementById('nilai').innerHTML=document.getElementById('inputradius').value*100
                            }

                            function rad5()
                            {
                              document.getElementById('rad5').innerHTML=document.getElementById('inputradius5').value*100
                            }

                            function rad3()
                            {
                              document.getElementById('rad3').innerHTML=document.getElementById('inputradius3').value*100
                            }

                            function rad4()
                            {
                              document.getElementById('rad4').innerHTML=document.getElementById('inputradius4').value*100
                            }

                            function rad6()
                            {
                              document.getElementById('rad6').innerHTML=document.getElementById('inputradius6').value*100
                            }

                          </script>
                        </div>
                      </ul>                     
                  </li>

                  <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-search"></i>
                        <span>Search Tourism By</span>
                    </a>
                    <ul class="sub">
                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Name</a>
                          <ul class="sub">
                            <li style="margin-top:10px"><input id="input_name" type="text" class="form-control"></li>                             
                            <li><a onclick="init();cari_tourism(1)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>

                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Address</a>
                          <ul class="sub">
                            <li style="margin-top:10px"><input id="input_address" type="text" class="form-control"></li>                             
                            <li><a onclick="init();cari_tourism(2)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>

                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Type</a>
                          <ul class="sub">
                            <li style="margin-top:10px">
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_jenis">
                              <?php                      
                              include('../connect.php');    
                              @$querysearch="SELECT id, name FROM tourism_type"; 
                              @$hasil=pg_query(@$querysearch);

                                while(@$baris = pg_fetch_array(@$hasil)){
                                    @$id=@$baris['id'];
                                    @$name=@$baris['name'];
                                    echo "<option value='@$id'>@$name</option>";
                                }
                              ?>
                            </select>
                            </li>                             
                            <li><a onclick="init();cari_tourism(3)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>

                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Fasility</a>
                          <ul class="sub">
                            <li style="margin-top:10px"><input id="input_fasility" type="text" class="form-control"></li>                                 
                            <li><a onclick="init();cari_tourism(4)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>
                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Worship Place</a>
                          <ul class="sub">
                            <li style="margin-top:10px">
                              <label for="inputradius5" style="font-size: 10pt; color:white;">Radius : </label>
                              <label  id="rad5"  style="font-size: 10pt; color:white;">0</label ><p style="font-size: 10pt; color:white;display:inline;"> m</p>
                              <input onchange="rad5()" type="range" id="inputradius5" name="inputradius5" data-highlight="true" min="0" max="20" value="0" >
                            </li>                                 
                            <li style="margin-top:10px">
                              <label for="input_facility" style="font-size: 10pt; color:white;">Facility : </label>
                              <input id="input_facility" type="text" class="form-control">
                            </li>                                 
                            <li><a onclick="init();cari_tourism(5)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>
                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Culinary Place</a>
                          <ul class="sub">
                            <li style="margin-top:10px">
                              <label for="inputradius3" style="font-size: 10pt; color:white;">Radius : </label>
                              <label  id="rad3"  style="font-size: 10pt; color:white;">0</label ><p style="font-size: 10pt; color:white;display:inline;"> m</p>
                              <input onchange="rad3()" type="range" id="inputradius3" name="inputradius3" data-highlight="true" min="0" max="20" value="0" >
                            </li>                                 
                            <li style="margin-top:10px">
                              <label for="facility_culinary" style="font-size: 10pt; color:white;">Facility : </label>
                              <input id="facility_culinary" type="text" class="form-control">
                            </li>                                 
                            <li style="margin-top:10px">
                              <label for="culinary" style="font-size: 10pt; color:white;">Culinary : </label>
                              <input id="culinary" type="text" class="form-control">
                            </li>                                 
                            <li><a onclick="init();cari_tourism(6)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>
                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Hotel</a>
                          <ul class="sub">     
                            <li style="margin-top:10px">
                              <label for="inputradius4" style="font-size: 10pt; color:white;">Radius : </label>
                              <label  id="rad4"  style="font-size: 10pt; color:white;">0</label ><p style="font-size: 10pt; color:white;display:inline;"> m</p>
                              <input onchange="rad4()" type="range" id="inputradius4" name="inputradius3" data-highlight="true" min="0" max="20" value="0" >
                            </li>                         
                            <li style="margin-top:10px">
                              <label for="h_facility" style="font-size: 10pt; color:white;">Facility : </label>
                              <input id="h_facility" type="text" class="form-control">
                            </li>                                 
                            <li style="margin-top:10px">
                              <label for="h_type" style="font-size: 10pt; color:white;">Type : </label>
                              <input id="h_type" type="text" class="form-control">
                            </li>                                 
                            <li><a onclick="init();cari_tourism(8)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>
                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Small Industry District</a>
                          <ul class="sub">      
                            <li style="margin-top:10px">
                              <label for="inputradius6" style="font-size: 10pt; color:white;">Radius : </label>
                              <label  id="rad6"  style="font-size: 10pt; color:white;">0</label ><p style="font-size: 10pt; color:white;display:inline;"> m</p>
                              <input onchange="rad6()" type="range" id="inputradius6" name="inputradius6" data-highlight="true" min="0" max="20" value="0" >
                            </li>                        
                            <li style="margin-top:10px">
                              <label for="district" style="font-size: 10pt; color:white;">District : </label>
                              <input id="district" type="text" class="form-control">
                            </li>                                 
                            <li style="margin-top:10px">
                              <label for="si_type" style="font-size: 10pt; color:white;">Type : </label>
                              <input id="si_type" type="text" class="form-control">
                            </li>                                 
                            <li><a onclick="init();cari_tourism(7)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>
                    </ul>
                  </li>
                  <!-- <li class="sub">
                      <a href="apps.apk" download>
                      <i class="fa fa-download" ></i>Download Android Apps</a>
                  </li> -->
                  <li class="sub">
                      <a onclick="backToHome();" style="cursor:pointer;background:none"><i class="fa fa-home"></i>Route to First Location</a>
                  </li>
                  <li class="sub-menu">
                      <a class="active" href=".././">
                          <i class="fa fa-hand-o-left"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end