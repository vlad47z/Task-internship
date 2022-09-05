

@if ($paginator->hasPages())
<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap">
                    <ul>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li>
                            <span aria-hidden="true">Previous</span>
                        </li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="enable" aria-disabled="true"><span>{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                        </li>
                    @else
                        <li aria-label="@lang('pagination.next')">
                            <span aria-hidden="true">Next</span>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
