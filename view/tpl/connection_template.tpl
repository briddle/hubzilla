<div id="contact-entry-wrapper-{{$contact.id}}">
	<div class="section-subtitle-wrapper clearfix">
		<div class="float-end">
			{{if $contact.approve && $contact.ignore}}
			<form action="connedit/{{$contact.id}}" method="post" >
			<button type="submit" class="btn btn-success btn-sm" name="pending" value="1" title="{{$contact.approve_hover}}"><i class="fa fa-check"></i> {{$contact.approve}}</button>

			<a href="connedit/{{$contact.id}}/ignore" class="btn btn-warning btn-sm" title="{{$contact.ignore_hover}}"><i class="fa fa-ban"></i> {{$contact.ignore}}</a>

			{{/if}}
			{{if $contact.connect}}
				<a href="{{$contact.follow}}" class="btn btn-success btn-sm" title="{{$contact.connect_hover}}"><i class="fa fa-plus"></i> {{$contact.connect}}</a>
			{{/if}}
			<a href="#" class="btn btn-danger btn-sm contact-delete-btn" title="{{$contact.delete_hover}}" onclick="dropItem('{{$contact.deletelink}}', '#contact-entry-wrapper-{{$contact.id}}'); return false;"><i class="fa fa-trash-o"></i> {{$contact.delete}}</a>
			<a href="{{$contact.link}}" class="btn btn-outline-secondary btn-sm" title="{{$contact.edit_hover}}"><i class="fa fa-pencil"></i> {{$contact.edit}}</a>
			{{if $contact.approve}}
			</form>
			{{/if}}
		</div>
		<h3>{{if $contact.public_forum}}<i class="fa fa-comments-o"></i>&nbsp;{{/if}}<a href="{{$contact.url}}" title="{{$contact.img_hover}}" >{{$contact.name}}</a>{{if $contact.phone}}&nbsp;<a class="btn btn-outline-secondary btn-sm" href="tel:{{$contact.phone}}" title="{{$contact.call}}"><i class="fa fa-phone connphone"></i></a>{{/if}}</h3>
	</div>
	<div class="section-content-tools-wrapper">
		<div class="contact-photo-wrapper" >
			<a href="{{$contact.url}}" title="{{$contact.img_hover}}" >
				<img class="directory-photo-img {{if $contact.classes}}{{$contact.classes}}{{/if}}" src="{{$contact.thumb}}" alt="{{$contact.name}}" loading="lazy" />
			</a>
			{{include "connstatus.tpl" perminfo=$contact.perminfo}}
		</div>
		<div class="contact-info">
			{{if $contact.status}}
			<div class="contact-info-element">
				<span class="contact-info-label">{{$contact.status_label}}:</span> {{$contact.status}}
			</div>
			{{/if}}
			{{if $contact.connected}}
			<div class="contact-info-element">
				<span class="contact-info-label">{{$contact.connected_label}}:</span> <span class="autotime" title="{{$contact.connected}}"></span>
			</div>
			{{/if}}
			{{if $contact.webbie}}
			<div class="contact-info-element">
				<span class="contact-info-label">{{$contact.webbie_label}}:</span> {{$contact.webbie}}
			</div>
			{{/if}}
			{{if $contact.network}}
			<div class="contact-info-element">
				<span class="contact-info-label">{{$contact.network_label}}:</span> {{$contact.network}} - <a href="{{$contact.recentlink}}" rel="nofollow noopener">{{$contact.recent_label}}</a>
			</div>
			{{/if}}
		</div>

	</div>
</div>

