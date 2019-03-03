@if ($paginator->hasPages())
    <div class="row pagination-wrap">
        <div class="col-full">
            <nav class="pgn" data-aos="fade-up">
                <ul>
                    {{-- Previous Page Link --}}
                    @if (!$paginator->onFirstPage())
                        <li><a class="pgn__prev" href="{{$paginator->previousPageUrl()}}">Prev</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                                    <li><a class="pgn__num current" href="{{ $url }}">{{ $page }}</a></li>
                                @else
                                    {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                                    <li><a class="pgn__num" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li><a class="pgn__next" href="{{$paginator->nextPageUrl()}}">Next</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
