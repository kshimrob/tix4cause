<div class="posts-block">
		@foreach($posts as $post)
		<a href="{{ route('post.show', $post->slug) }}" class="card">
			<div class="image" style="background-image:url({{ Voyager::image($post->image) }})"></div>
			<div class="text">
				<h3>{{ $post->title }}</h3>
				<p>{{ str_limit($post->excerpt, $limit = 150, $end= '...') }} <span>Read More</span></p>
			</div>
		</a>
		@endforeach
</div>