[main]
<div class="card text-center">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item active">
				<button class="nav-link active" data-toggle="pill" href="#magazine-collapse">{LANG:MAGAZINE}</button>
			</li>
			<li class="nav-item">
				<button class="nav-link" data-toggle="pill" href="#group-collapse">{LANG:GROUP}</button>
			</li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="card-body tab-pane fade in active show" id="magazine-collapse">
			<div class="accordion" id="accordionone">
				{MAGAZINE_GROUPS}
			</div>
		</div>
		<div class="card-body tab-pane fade" id="group-collapse">
			<div class="accordion" id="accordiontwo">
				{GROUP_GROUPS}
			</div>
		</div>
	</div>
</div>



[collapse_group]
<div class="card">
	<div class="card-header" id="heading{GROUP_NR}">
		<h5 class="mb-0">
			<a class="btn btn-block collapsed" data-toggle="collapse" data-parent="#accordion{PARENT_NR}" href="#collapse{GROUP_NR}" aria-expanded="false" aria-controls="collapse{GROUP_NR}">
			  {GROUP_TITLE}
			</a>
		</h5>
	</div>
	<div id="collapse{GROUP_NR}" class="collapse" aria-labelledby="heading{GROUP_NR}" data-parent="#accordion{PARENT_NR}">
		<div class="card-body">
			{GROUP_CONTENT}
		</div>
	</div>
</div>

[recipe] 
<a class="btn btn-block" href="{LINK_URL}recipe/show/{RECIPE_ID}">{RECIPE_TITLE}</a>