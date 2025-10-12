@if(isset($item['is_separator']) && $item['is_separator'])
    <!-- Separator -->
    @if(isset($isChild) && $isChild)
        <!-- Dropdown Separator -->
        @if(isset($item['text']) && $item['text'])
            <h6 class="dropdown-header">{{ $item['text'] }}</h6>
        @else
            <div class="dropdown-divider"></div>
        @endif
    @else
        <!-- Main Navigation Separator -->
        @if(isset($item['text']) && $item['text'])
            <li class="nav-item">
                <span class="nav-link-title text-muted small text-uppercase fw-bold px-3 py-2">{{ $item['text'] }}</span>
            </li>
        @else
            <!-- Vertical Separator for Horizontal Navbar -->
            <li class="nav-item">
                <span class="nav-link nav-separator" aria-hidden="true">|</span>
            </li>
        @endif
    @endif
@elseif($item['has_children'])
    @if(isset($isChild) && $isChild && isset($item['dropdown_type']) && $item['dropdown_type'] === 'nested')
        <!-- Nested Dropdown (Dropend) -->
        <div class="dropend">
            <a class="dropdown-item dropdown-toggle {{ $item['is_active'] ? 'active' : '' }}"
               href="#sidebar-{{ Str::slug($item['text']) }}"
               data-bs-toggle="dropdown" data-bs-auto-close="outside"
               role="button" aria-expanded="false">
                @if(isset($item['icon']))
                    <x-icon name="{{ $item['icon'] }}" class="me-2" />
                @endif
                {{ $item['text'] }}
            </a>
            <div class="dropdown-menu">
                @foreach($item['children'] as $child)
                    @include('partials.admin.menu-item', ['item' => $child, 'isChild' => true, 'isNested' => true])
                @endforeach
            </div>
        </div>
    @else
        <!-- Main Dropdown Menu Item -->
        <li class="nav-item dropdown {{ $item['is_active'] ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" href="#navbar-{{ Str::slug($item['text']) }}"
               data-bs-toggle="dropdown" data-bs-auto-close="outside"
               role="button" aria-expanded="false">
                @if(isset($item['icon']))
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon name="{{ $item['icon'] }}" />
                    </span>
                @endif
                <span class="nav-link-title">{{ $item['text'] }}</span>
            </a>

            @if(isset($item['dropdown_type']) && $item['dropdown_type'] === 'columns')
                <!-- Multi-column Dropdown -->
                <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                        @php
                            $columns = $item['dropdown_columns'] ?? 2;
                            $groupedChildren = [];
                            foreach($item['children'] as $child) {
                                $column = $child['column'] ?? 1;
                                if (!isset($groupedChildren[$column])) {
                                    $groupedChildren[$column] = [];
                                }
                                $groupedChildren[$column][] = $child;
                            }
                        @endphp
                        @for($i = 1; $i <= $columns; $i++)
                            <div class="dropdown-menu-column">
                                @if(isset($groupedChildren[$i]))
                                    @foreach($groupedChildren[$i] as $child)
                                        @include('partials.admin.menu-item', ['item' => $child, 'isChild' => true])
                                    @endforeach
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                <!-- Standard Dropdown -->
                <div class="dropdown-menu">
                    @foreach($item['children'] as $child)
                        @include('partials.admin.menu-item', ['item' => $child, 'isChild' => true])
                    @endforeach
                </div>
            @endif
        </li>
    @endif
@else
    <!-- Single Menu Item -->
    @if(isset($isChild) && $isChild)
        <!-- Dropdown Item -->
        <a class="dropdown-item {{ $item['is_active'] ? 'active' : '' }}"
           href="{{ $item['url_resolved'] }}"
           @if(isset($item['target'])) target="{{ $item['target'] }}" @endif>
            @if(isset($item['icon']))
                <x-icon name="{{ $item['icon'] }}" class="me-2" />
            @endif
            {{ $item['text'] }}
            @if(isset($item['badge']))
                <span class="badge {{ $item['badge']['class'] }}">{{ $item['badge']['text'] }}</span>
            @endif
        </a>
    @else
        <!-- Main Nav Item -->
        <li class="nav-item {{ $item['is_active'] ? 'active' : '' }}">
            <a class="nav-link"
               href="{{ $item['url_resolved'] }}"
               @if(isset($item['target'])) target="{{ $item['target'] }}" @endif>
                @if(isset($item['icon']))
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <x-icon name="{{ $item['icon'] }}" />
                    </span>
                @endif
                <span class="nav-link-title">{{ $item['text'] }}</span>
                @if(isset($item['badge']))
                    <span class="badge {{ $item['badge']['class'] }}">{{ $item['badge']['text'] }}</span>
                @endif
            </a>
        </li>
    @endif
@endif
