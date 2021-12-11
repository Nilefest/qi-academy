@if ($faq_list->count())
    <div class="faq container">
        <h3>Często zadawane pytania:</h3>
        <ul class="faq_ul">
            @foreach ($faq_list as $faq_item)
                <li class="faq_li">
                    <span class="quest">{{ $faq_item->title }}</span>
                    <span class="answer">{{ $faq_item->info }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
