<div class="generic-content-wrapper">
	<div class="section-title-wrapper">
		<h2>{{$title}}</h2>
		<div class="clear"></div>
	</div>
	<div class="section-content-tools-wrapper">
		<div class="section-content-info-wrapper">
			{{$desc}}
		</div>

		<form action="permcats" id="settings-permcats-form" method="post" autocomplete="off" >
			<input type='hidden' name='form_security_token' value='{{$form_security_token}}'>
			{{include file="field_input.tpl" field=$name}}

			<div class="settings-submit-wrapper mb-3">
				<button type="submit" name="submit" class="btn btn-primary">{{$submit}}</button>
			</div>
	</div>

	<div class="panel" id="permission-settings">
		<div class="section-subtitle-wrapper" role="tab" id="perms-tool">
			<h3>
				<a data-bs-toggle="collapse" data-bs-parent="#permission-settings" href="#perms-tool-collapse" aria-expanded="true" aria-controls="perms-tool-collapse">
				{{$permlbl}}
				</a>
			</h3>
		</div>
		<div id="perms-tool-collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="perms-tool">
			<div class="section-content-tools-wrapper">
				<div class="section-content-warning-wrapper">
				{{$permnote}}
				</div>

				<table id="perms-tool-table" class=mb-3>
					<tr>
						<td></td><td colspan="2" class="abook-me">{{$me}}</td>
					</tr>
						{{foreach $perms as $prm}}
						{{include file="field_acheckbox.tpl" field=$prm}}
						{{/foreach}}
				</table>

				<div class="settings-submit-wrapper" >
					<button type="submit" name="submit" class="btn btn-primary">{{$submit}}</button>
				</div>
			</div>
		</div>
		{{if $permcats}}
		<div class="section-content-wrapper-np">
			<table id="permcat-index">
			{{foreach $permcats as $k => $v}}
			<tr class="permcat-row-{{$k}}">
				<td width="99%"><a href="permcats/{{$k}}">{{$v}}</a></td>
				<td width="1%"><i class="fa fa-trash-o drop-icons" onClick="dropItem('permcats/{{$k}}/drop', '.permcat-row-{{$k}}')"></i></td>
			</tr>
			{{/foreach}}
			</table>
		</div>
		{{/if}}

	</div>
	</form>

</div>
