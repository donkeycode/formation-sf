import { Component, OnInit } from '@angular/core';
import { PostsService } from '../posts.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-book',
  templateUrl: './book.component.html',
  styleUrls: ['./book.component.scss']
})
export class BookComponent implements OnInit {

  public post;

  constructor(private postsService: PostsService, private route: ActivatedRoute) { }

  ngOnInit() {
    const postId = this.route.snapshot.params.id;

    this.postsService
        .getPost(postId)
        .subscribe((post) => { this.post = post; });
  }

}
