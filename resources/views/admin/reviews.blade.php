@extends('layouts.app_admin')

@section('footer.js')
    <script src="{{ asset('js/adm_review.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('templates')
    <template id="tpl_review_item">
        <tr class="review_item" data-courseId="-1">
            <td class="tools"><i class="fas fa-trash-alt icon_tool remove_review"></i></td>
            <td>
                <label>
                    <span class="title">Ссылка на видео отзыв</span>
                    <input type="text" class="text review_video" value="" placeholder="https://...">
                </label>
            </td>
        </tr>
    </template>
@endsection

@section('content')
    <div class="content container">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <h1 class="title">Редактор отзывов</h1>
        <div class="reviews_form" data-formAction="{{ route('admin.reviews.post') }}">
            <table>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="review_item" data-reviewId="{{ $review->id }}">
                            <td class="tools"><i class="fas fa-trash-alt icon_tool remove_review"></i></td>
                            <td>
                                <label>
                                    <span class="title">Ссылка на видео отзыв</span>
                                    <input type="text" class="text review_video" value="{{ $review->video }}" placeholder="https://...">
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="button add_review"><i class="fas fa-plus icon_add"></i></button>
            <button class="button save_reviews">Сохранить данные</button>
        </div>
    </div>
@endsection
