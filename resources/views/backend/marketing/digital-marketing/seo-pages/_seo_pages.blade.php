<table class="table table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>URL</th>
            <th>Description</th>
            <th>Keyword</th>
            <th>Date</th>
            <th>Image</th>
            <th>Icon</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($seoPages as $seoPage)
        <tr>
            <td>{{ $seoPage->title }}</td>
            <td>{{ $seoPage->url }}</td>
            <td>{{ $seoPage->description }}</td>
            <td>{{ $seoPage->keyword }}</td>
            <td>{{ $seoPage->date }}</td>
            <td>{{ $seoPage->is_image_active ? 'Yes' : 'No' }}</td>
            <td>{{ $seoPage->is_icon_active ? 'Yes' : 'No' }}</td>
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
