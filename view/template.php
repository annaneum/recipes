[accordion]
<div class="accordion" id="accordion{ACC_NR}">
	{ACCORDION_ELEMENTS}
</div>

[accordion_element]
<div class="card">
	<div class="card-header" id="heading{ELEMENT_NR}">
		<h5 class="mb-0">
			<a class="btn btn-block collapsed" data-toggle="collapse" data-parent="#accordion{ACC_NR}" href="#collapse{ELEMENT_NR}" aria-expanded="false" aria-controls="collapse{ELEMENT_NR}">
			  {ELEMENT_TITLE}
			</a>
		</h5>
	</div>
	<div id="collapse{ELEMENT_NR}" class="collapse" aria-labelledby="heading{ELEMENT_NR}" data-parent="#accordion{ACC_NR}">
		<div class="card-body">
			{ELEMENT_CONTENT}
		</div>
	</div>
</div>