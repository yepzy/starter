@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-pen fa-fw"></i>
        @if($article)
            @lang('admin.title.parent.edit', [
                'entity' => __('entities.articles'), 'detail' => $article->title,
                'parent' => __('entities.news')
            ])
        @else
            @lang('admin.title.parent.create', [
                'entity' => __('entities.articles'),
                'parent' => __('entities.news')
            ])
        @endif
    </h1>
    <hr>
    <form action="{{ $article ? route('news.article.update', ['id' => $article->id]) : route('news.article.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if($article)
            @method('PUT')
        @endif()
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('admin.section.data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('admin.section.media')</h3>
                @php($illustration = optional($article)->getFirstMedia('illustration'))
                {{ bsFile()->name('illustration')
                    ->value(optional($illustration)->file_name)
                    ->uploadedFile(function() use ($illustration) {
                        return $illustration
                            ? image()->src($illustration->getUrl('thumb'))
                                ->linkUrl($illustration->getUrl('cover'))
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->showRemoveCheckbox(false)
                    ->containerHtmlAttributes(['required'])
                    ->legend((new \App\Models\NewsArticle)->constraintsLegend('illustration')) }}
                <h3 class="pt-4">@lang('admin.section.identity')</h3>
                {{ bsText()->name('title')->model($article)->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('url')
                    ->model($article)
                    ->prepend(route('news.article.show', [$article]) . '/')
                    ->componentClasses(['slugify'])
                    ->componentHtmlAttributes(['data-target' => '#text-title'])
                    ->containerHtmlAttributes(['required']) }}
                <h3 class="pt-4">@lang('admin.section.information')</h3>
                {{ bsSelect()->name('category_ids')
                    ->model($article)
                    ->prepend(' <i class="fas fa-tags"></i>')
                    ->options((new \App\Models\NewsCategory)->orderBy('title')->get(), 'id', 'title')
                    ->multiple()
                    ->componentClasses(['selector'])
                    ->containerHtmlAttributes(['required']) }}
                {{ bsTextarea()->name('description')->model($article)->componentClasses(['editor'])->prepend(false) }}
                <h3 class="pt-4">@lang('admin.section.publication')</h3>
                {{ bsText()->name('published_at')
                    ->value(($article ? $article->published_at : now())->format('d/m/Y H:i'))
                    ->prepend('<i class="fas fa-calendar-alt"></i>')
                    ->componentClasses(['datetime-picker'])
                    ->containerHtmlAttributes(['required']) }}
                {{ bsToggle()->name('active')->model($article) }}
                <div class="d-flex pt-4">
                    {{ bsCancel()->route('news.articles')->containerClasses(['mr-2']) }}
                    @if($article){{ bsUpdate() }}@else{{ bsCreate() }}@endif
                </div>
            </div>
        </div>
    </form>
@endsection
