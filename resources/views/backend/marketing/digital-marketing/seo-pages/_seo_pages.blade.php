<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>URL</th>
            <th>Image</th>
            <th>Description</th>
            <th>Keyword</th>
            <th>Create Date</th>
            <th>Image</th>
            <th>Icon</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($seoPages as $seoPage)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $seoPage->title }}</td>
            <td>{{ $seoPage->url }}</td>
            <td><img src="{{ asset('storage/'.$seoPage->image) }}" class="rounded"
                style="width: 55px; height: 40px;" /></td>
            <td>{!! $seoPage->description !!}</td>
            <td>{!! $seoPage->keyword !!}</td>
            <td>{{ $seoPage->date }}</td>
            <td>{{ $seoPage->is_image_active ? 'Yes' : 'No' }}</td>
            <td>{{ $seoPage->is_icon_active ? 'Yes' : 'No' }}</td>
            <td>{{ $seoPage->is_date_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('seo-pages.edit', $seoPage->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('seo-pages.destroy', $seoPage->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$seoPages->links()}}
