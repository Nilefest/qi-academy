@if (!empty($video_reviews))
    <div class="block_video_reviews container">
        <div class="block_video_reviews_info" style="min-height: 150px">
            <h3>FEEDBACK</h3>
        </div>
        <div class="block_video_reviews_slider">
            <ul class="block_video_reviews_ul">
                @foreach ($video_reviews as $review)
                    <li style="background-image: url('https://img.youtube.com/vi/{{ $review['youtube_code'] }}/mqdefault.jpg');"
                        data-videoCode="{{ $review['youtube_code'] }}" class="youtube_open_modal block_video_reviews_li">
                        <button class="block_video_reviews_button">&#9654;</button>
                    </li>
                @endforeach
            </ul>
            <button class="block_video_reviews_arrow prev">&#8592;</button>
            <button class="block_video_reviews_arrow next">&#8594;</button>
        </div>
    </div>
@endif
