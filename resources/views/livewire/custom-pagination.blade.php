@if ($paginator->hasPages())
    <div class="table-pagination">
        <div class="flex items-center justify-between">
        <nav class="pagination my-6">
            <ul>
                @if (!$paginator->onFirstPage())
                <li>
                    <button wire:click="previousPage" rel="prev">Previous</button>
                </li>
                @endif
                
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <button disabled>{{ $element }}</button>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <button class="active" disabled>{{ $page }}</button>
                                </li>
                            @else
                                <li>
                                    <button wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <button wire:click="nextPage" rel="next" wire:click="previousPage" rel="prev">Next</button>
                    </li>
                @endif
                
            </ul>
        </nav>
        <small>Page 1 of 10</small>
        </div>
    </div>
@endif