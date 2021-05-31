<form method="POST" action="{{ route('user.destroy', $id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure to delete user?')" title="delete"
        class="btn btn-sm btn-danger">
        <i class="fa fa-user-times"></i>
    </button>
</form>
