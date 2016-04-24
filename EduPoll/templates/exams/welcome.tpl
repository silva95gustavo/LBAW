{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">

					<ol class="breadcrumb">
						{if isAdmin() }
							<li><a href="{$BASE_URL}pages/admin/main.php">Home</a></li>
						{elseif isAcademic() }
							<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
						{/if}
						<li class="active">Exam</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>LAIG - Avaliação Individual 2</h2>
						<p>25/02/2016 10:00-13:00</p>
					</div>

					<div class="page-header">
						<h1>Information</h1>
					</div>
					<div class="well">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Pellentesque pulvinar lacus ac neque fermentum dictum. Curabitur
							vel dui id turpis sollicitudin semper in eget nisi. Donec
							lobortis ultrices mi, eget porttitor eros sagittis eget. Etiam
							lobortis id tellus ac mattis. Sed bibendum quam erat, ut sagittis
							nisl placerat non. Morbi sodales, sem id commodo porttitor, felis
							tortor interdum elit, vitae tempor enim erat et purus. Nam
							sagittis egestas urna, ac aliquam justo mattis quis. Pellentesque
							fringilla metus ante, vel tempus nisl placerat at. Suspendisse
							potenti. Integer sem sapien, volutpat at convallis non,
							sollicitudin vitae eros. Nam et pellentesque dolor. Vivamus
							luctus orci ante, eget ultrices tortor porta sit amet.
							Pellentesque consequat hendrerit quam, et posuere est maximus eu.</p>

							<p>Sed molestie, sapien eget semper semper, tellus erat lacinia
							purus, id ornare lorem elit ut leo. Nullam volutpat molestie
							risus, vel convallis purus posuere ut. Fusce dignissim quis neque
							vitae molestie. Aliquam quam risus, condimentum et molestie
							vitae, scelerisque sit amet augue. Duis at consectetur dolor.
							Duis non feugiat lacus. Aliquam sed ipsum arcu. In elit libero,
							scelerisque sed nunc id, congue ultricies massa. Curabitur tempor
							fermentum eleifend. Ut a placerat augue, ac tempor ligula. Morbi
							et ligula egestas, imperdiet mauris commodo, molestie nibh. Nunc
							bibendum molestie faucibus. Integer fermentum vehicula urna in
							varius. Nullam placerat viverra turpis, quis congue justo
							tincidunt sed. Nullam accumsan, mi elementum euismod convallis,
							ipsum justo elementum ante, id efficitur tellus neque dapibus
							arcu. Morbi euismod elit a ultricies interdum. Aliquam ex turpis,
							euismod at luctus a, tempor sed nisi. Aliquam facilisis tristique
							lectus eget volutpat. Aliquam orci orci, bibendum a imperdiet
							vitae, lobortis a lorem. Sed id magna elit. Sed sollicitudin,
							risus quis bibendum vehicula, urna mi ornare ante, non rhoncus
							est lectus dictum mi. Nulla venenatis purus sit amet nulla
							feugiat, at pharetra lectus sodales. In ut diam massa. Vestibulum
							ante ipsum primis in faucibus orci luctus et ultrices posuere
							cubilia Curae; Donec elementum lacus vel dapibus bibendum.</p>
					</div>
					
					<a href="take-exam.html"><button type="button" class="btn btn-primary">Take exam</button><p></p></a>
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}