<form class="searchbar" action="/filter" method="post">
    @csrf
    <select name="category">
        <option class="title-category" value="">Shop By Categories</option>
        @foreach ($categories as $category)
        @isset($selectcategory))
        @if($category->name == $selectcategory)
        <option class="title-category" value="{{ $category->name }}" selected>{{ $category->name }}</option>
        @else
        @if ($category->parent_category == null)
        <option class="parent-category" value="{{ $category->name }}">{{ $category->name }}</option>
        @foreach ($categories as $child_category)
        @if ($child_category->parent_category == $category->id)
        <option class="child-category" value="{{ $child_category->name }}">
            {{ $child_category->name }}
        </option>
        @endif
        @endforeach
        {{-- @else
                <option value="{{ $category->name }}">{{ $category->name }}</option> --}}
        @endif
        @endif
        @endisset
        @empty($selectcategory)
        @if ($category->parent_category == null)
        <option class="parent-category" value="{{ $category->name }}">{{ $category->name }}</option>
        @foreach ($categories as $child_category)
        @if ($child_category->parent_category == $category->id)
        <option class="child-category" value="{{ $child_category->name }}">
            {{ $child_category->name }}
        </option>
        @endif
        @endforeach
        {{-- @else
                <option value="{{ $category->name }}">{{ $category->name }}</option> --}}
        @endif
        @endempty
        @endforeach
    </select>
    <input type="text" name="searchbar" placeholder="What are you looking for ?">
    <select name="location">
        <option value="">Select a city</option>
        @foreach ($cities as $city)
        @isset($selectcity))
        @if ($city->location == $selectcity)
        <option value="{{$city->location}}" selected>{{$city->location}}</option>
        @else
        <option value="{{$city->location}}">{{$city->location}}</option>
        @endif
        @endisset
        @empty($selectcity)
        <option value="{{$city->location}}">{{$city->location}}</option>
        @endempty
        @endforeach
    </select>
    <button type="submit">Search</button>
</form>