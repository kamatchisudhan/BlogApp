@extends('layouts.app')
@section('content')
<div class="row">
    @foreach($blogs as $blog)
    <div class="col-md-4 mb-4">
        <div class="blog-post">
        <div class="card-body">
        <img src="{{ asset($blog->image) }}" alt="Blog Image" class="img-fluid">          
                <h5 class="card-title">{{ $blog->title }}</h5>
                <p class="short-desc">{{ Str::limit($blog->description, 100) }}</p>
        <p class="full-desc d-none">{{ $blog->description }}</p>
        <button class="btn btn-primary read-more-btn">Read More</button>
                
                <div class="mt-3">
                    <h6>Comments</h6>
                    <ul class="list-group" id="comments-list-{{ $blog->id }}">
                        @foreach($blog->comments as $comment)
                            <li class="list-group-item">{{ $comment->comment }}</li>
                        @endforeach
                    </ul>
                    <form id="comment-form" action="/comments" method="POST">
    @csrf
    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
    <textarea name="comment" required></textarea>
    <button type="submit">Submit</button>
</form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<style>
  

</style>

<script>
document.getElementById('comment-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch('/comments', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".read-more-btn").forEach(button => {
        button.addEventListener("click", function () {
            let parent = this.closest(".blog-post");
            let shortDesc = parent.querySelector(".short-desc");
            let fullDesc = parent.querySelector(".full-desc");

            if (fullDesc.classList.contains("d-none")) {
                shortDesc.style.display = "none";
                fullDesc.classList.remove("d-none");
                this.textContent = "Read Less";
            } else {
                shortDesc.style.display = "block";
                fullDesc.classList.add("d-none");
                this.textContent = "Read More";
            }
        });
    });
});
</script>
@endsection
