{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}

					<ol class="breadcrumb">
						<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
						<li><a href="my-exams.html">My Exams</a></li>
						<li class="active">Exam statistics</li>
					</ol>

					<div class="jumbotron">
						<h1>LBAW - Test 1: Statistics</h1>
						<p>22-01-2015 12:00-14:00</p>
					</div>

					<div class="row text-center">
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>Number of Submitted Exams</strong>
								</div>
								<div class="panel-body">50</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>Number of Approved Exams</strong>
								</div>
								<div class="panel-body">43</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>Average Score</strong>
								</div>
								<div class="panel-body">12.3</div>
							</div>
						</div>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#questions">Questions Summary</a></li>
						<li><a data-toggle="tab" href="#students">Students Summary</a></li>
						<li><a id="AStab" data-toggle="tab" href="#AS">Approved Students</a></li>
						<li><a id="GDtab" data-toggle="tab" href="#GD">Grades Distribution</a></li>
						<li><a data-toggle="tab" href="#downloads">Export Statistics</a></li>
					</ul>

					<div class="tab-content">
						<div id="questions" class="tab-pane fade in active">
							<h3>Questions Summary</h3>
							<div id="questions-stats" class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Question</th>
											<th>Number of Answers</th>
											<th>Correct Answers</th>
											<th>% of Correct Answers</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>48</td>
											<td>36</td>
											<td>75.0</td>
										</tr>
										<tr>
											<td>2</td>
											<td>50</td>
											<td>41</td>
											<td>82.0</td>
										</tr>
										<tr>
											<td>3</td>
											<td>50</td>
											<td>34</td>
											<td>68.0</td>
										</tr>
										<tr>
											<td>4</td>
											<td>42</td>
											<td>15</td>
											<td>35.7</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="students" class="tab-pane fade">
							<h3>Students Summary</h3>
							<div id="students-stats" class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Name</th>
											<th>Number of Questions Answered</th>
											<th>Number of Correct Answers</th>
											<th>Grade</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>AndrÃ© Lago</td>
											<td>50</td>
											<td>50</td>
											<td>20.0</td>
										</tr>
										<tr>
											<td>Guilherme Pinto</td>
											<td>50</td>
											<td>45</td>
											<td>18.0</td>
										</tr>
										<tr>
											<td>Gustavo Silva</td>
											<td>50</td>
											<td>0</td>
											<td>0.0</td>
										</tr>
										<tr>
											<td>Pedro Castro</td>
											<td>47</td>
											<td>46</td>
											<td>18.0</td>
										</tr>
										<tr>
											<td>There Are Too Many Students</td>
											<td>25</td>
											<td>25</td>
											<td>10.0</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div id="AS" class="tab-pane fade text-center">
							<h3>Approved Students</h3>
								<canvas id="AScanvas" width="600" height="350"></canvas>
						</div>
						<div id="GD" class="tab-pane fade text-center">
							<h3>Grades Distribution</h3>
								<canvas id="GDcanvas" width="600" height="350"></canvas>
						</div>
						<div id="downloads" class="tab-pane fade">
							<h3>Export Statistics</h3>
								<div class="jumbotron">
									<div class="row">
										<div class="col-md-4"><button class="btn-primary btn-lg">Export PDF</button></div>
										<div class="col-md-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet ornare aliquet. Maecenas interdum lacus enim, vel ultrices est pulvinar vel. Sed vitae interdum nibh. Curabitur et justo ullamcorper, ullamcorper leo vel, imperdiet dolor. Proin egestas nisl in porttitor convallis. Proin maximus tempor elit, in semper eros mollis in. Donec lobortis magna ut massa feugiat, eu porta nulla sollicitudin. Donec lobortis iaculis felis at tempus. Quisque ac lectus libero. Nulla diam turpis, mollis vitae dapibus et, facilisis vitae erat. In pellentesque, sapien ac sagittis consectetur, erat ante egestas purus, id scelerisque mauris nibh eget tortor. Nunc pretium mauris eros, quis consequat ipsum convallis a. In sodales congue felis, eget elementum mauris finibus euismod. Nunc vitae fermentum lacus. Morbi tempor neque non tortor rutrum malesuada. Integer bibendum risus elementum nulla viverra, vitae imperdiet urna pharetra.</div>
									</div>
									
								</div>
								<div class="jumbotron">
									<div class="row">
										<div class="row">
											<div class="col-md-4"><button class="btn-primary btn-lg">Export CLS</button></div>
											<div class="col-md-8">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse ac mi ex. Suspendisse elit risus, dictum sit amet turpis quis, imperdiet venenatis risus. Etiam quis velit augue. In cursus luctus eros, id blandit lacus aliquet sit amet. Fusce ut sapien eget lectus feugiat aliquet vel in ligula. Nulla maximus sed arcu vitae tristique.</div>
										</div>
									</div>
									
								</div>
						</div>
					</div>

					

				</div>
			</div>
		</div>
	</div>

	<script src="{$BASE_URL}frameworks/Chart.js"></script>
	<script src="{$BASE_URL}javascript/exam-statistics.js"></script>
{include file='common/footer.tpl'}