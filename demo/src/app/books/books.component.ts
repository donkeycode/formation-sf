import { Component, OnInit } from '@angular/core';
import { PostsService } from '../posts.service';

@Component({
  selector: 'app-books',
  templateUrl: './books.component.html',
  styleUrls: ['./books.component.scss']
})
export class BooksComponent implements OnInit {

  public posts;

  constructor(private postsService: PostsService) { }

  ngOnInit() {
    this.postsService
      .getAllPosts()
      .subscribe((posts) => { this.posts = posts; });
  }

}
