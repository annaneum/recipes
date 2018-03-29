[main]
<div id="accordion">
  {GROUPS}
  
</div>

[collapse_group]
<div class="card">
	<div class="card-header" id="heading{GROUP_NR}">
		<h5 class="mb-0">
			<a class="btn btn-block collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{GROUP_NR}" aria-expanded="false" aria-controls="collapse{GROUP_NR}">
			  {GROUP_TITLE}
			</a>
		</h5>
	</div>
	<div id="collapse{GROUP_NR}" class="collapse" aria-labelledby="heading{GROUP_NR}" data-parent="#accordion">
		<div class="card-body">
			{GROUP_CONTENT}
		</div>
	</div>
</div>