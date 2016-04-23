{include file='common/header.tpl'}

	<!-- Fixed navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="main.html">EduPoll</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="exams-taken.html">Previous Exams</a></li>
					<li><a href="create-exam.html">Create Exam</a></li>
					<li><a href="my-exams.html">My Exams</a></li>
					<li><a href="index.html">Logout</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">

				<div class="calendar-mini">
					<div class="calendar-month">
						<ul class="calendar-header">
							<li class="calendar-prev-month">❮</li>
							<li class="calendar-next-month">❯</li>
							<li style="text-align: center">August<br> <span
								style="font-size: 18px">2016</span>
							</li>
						</ul>
					</div>

					<ul class="calendar-weekdays">
						<li>Mo</li><li>Tu</li><li>We</li><li>Th</li><li>Fr</li><li>Sa</li><li>Su</li>
					</ul>

					<ul class="calendar-days">
						<li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li><li>
						<span class="calendar-day-active">10</span></li><li>11</li><li>12</li><li>13</li><li>14</li><li>15
						</li><li>16</li><li>17</li><li>18</li><li>19</li><li>20</li><li>21</li><li>22</li><li>23</li><li>
						24</li><li>25</li><li>26</li><li>27</li><li>28</li><li>29</li><li>30</li><li>31</li>
					</ul>
				</div>
				
          	</br></br><ul class="nav nav-sidebar" text-align="right">
            	<li><a href="edit-profile.html">André Sousa Lago</a></li>
          	</ul>
          
			</div>
			
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">
					<ol class="breadcrumb">
						<li class="active">Home</li>
					</ol>

					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">Ongoing exams</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">LBAW - Teste 1</h4> <datetime
										class="list-group-item-text">22-01-2015 12:00-14:00</datetime>
									<p class="list-group-item-text">This exam starts in less
										than 10 minutes!</p>
								</a>
							</div>
						</div>
					</div>
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Upcoming exams</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">IART - Teste 1</h4> <datetime
										class="list-group-item-text">25-01-2015 12:00-14:00</datetime>
								</a> <a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">COMP - Avaliação
										Individual 1</h4> <datetime class="list-group-item-text">27-01-2015
									12:00-14:00</datetime>
								</a> <a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">SDIS - Prova 2</h4> <datetime
										class="list-group-item-text">29-01-2015 12:00-14:00</datetime>
								</a>
							</div>
						</div>
					</div>
					<div class="last-element panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Future exams</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">LBAW - Teste 2</h4> <datetime
										class="list-group-item-text">05-02-2015 12:00-14:00</datetime>
								</a> <a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">COMP - Avaliação
										Individual 2</h4> <datetime class="list-group-item-text">15-02-2015
									12:00-14:00</datetime>
								</a> <a href="exam-welcome.html" class="list-group-item">
									<h4 class="list-group-item-heading">SDIS - Prova 3</h4> <datetime
										class="list-group-item-text">23-02-2015 12:00-14:00</datetime>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
	<!-- /container -->
	
{include file='common/footer.tpl'}