<div class="wall-item-outside-wrapper{{if $indent}} {{$indent}}{{/if}}" id="wall-item-outside-wrapper-{{$id}}" >
	<div class="clearfix wall-item-content-wrapper{{if $indent}} {{$indent}}{{/if}}" id="wall-item-content-wrapper-{{$id}}">
		<div class="p-2 clearfix wall-item-head">
			<div class="wall-item-info" id="wall-item-info-{{$id}}" >
				<div class="wall-item-photo-wrapper" id="wall-item-photo-wrapper-{{$id}}" >
					<a href="{{$profile_url}}" title="View {{$name}}'s profile" class="wall-item-photo-link" id="wall-item-photo-link-{{$id}}">
					<img src="{{$thumb}}" class="wall-item-photo" id="wall-item-photo-{{$id}}" alt="{{$name}}" /></a>
				</div>
			</div>
			<div class="wall-item-wrapper" id="wall-item-wrapper-{{$id}}" >
				<div class="wall-item-author">
					<a href="{{$profile_url}}" title="View {{$name}}'s profile" class="wall-item-name-link"><span class="wall-item-name" id="wall-item-name-{{$id}}" >{{$name}}</span></a>
				</div>
				<div class="wall-item-ago"  id="wall-item-ago-{{$id}}">{{$ago}}</div>
			</div>
		</div>
		<div class="p-2 clearfix wall-item-content" id="wall-item-content-{{$id}}" >
			<div class="wall-item-title" id="wall-item-title-{{$id}}">{{$title}}</div>
			<div class="wall-item-body" id="wall-item-body-{{$id}}" >{{$body}}</div>

		</div>
		{{if $drop}}
		<div class="p-2 clearfix wall-item-tools" id="wall-item-tools-{{$id}}" >
			<div class="wall-item-tools-right float-end">
				{{$drop}}
			</div>
		</div>
		{{/if}}
		{{$comment}}
	</div>
</div>

