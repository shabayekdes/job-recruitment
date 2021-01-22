@if ($paginator->hasPages())

<div class="careerfy-pagination-blog">
    <ul class="page-numbers">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="prev page-numbers page-link" href="#" aria-label="Previous"><span
                    aria-hidden="true"><i class="careerfy-icon careerfy-arrows4"></i></span></a></li>
        @else
        <li><a class="prev page-numbers" href="{{ getQueryUrl($paginator->previousPageUrl()) }}" aria-label="Previous"><span
                    aria-hidden="true"><i class="careerfy-icon careerfy-arrows4"></i></span></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link page-numbers current">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                
                    @if ($page == $paginator->currentPage())
                        <li class="page-item"><span class="page-link page-numbers current">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link page-numbers" href="{{ getQueryUrl($url) }}">{{ $page }}</a></li>
                    @endif

                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="next page-numbers page-link" href="{{ getQueryUrl($paginator->nextPageUrl()) }}"
                aria-label="Next"><span aria-hidden="true"><i class="careerfy-icon careerfy-arrows4"></i></span></a>
        </li>
        @else
        <li class="page-item disabled"><a class="next page-numbers page-link" href="#" aria-label="Next"><span
                    aria-hidden="true"><i class="careerfy-icon careerfy-arrows4"></i></span></a></li>
        @endif
    </ul>
</div>




<!-- .pager end -->

@endif