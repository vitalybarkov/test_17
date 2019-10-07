import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-add-movie',
  templateUrl: './add-movie.component.html',
  styleUrls: ['./add-movie.component.scss']
})
export class AddMovieComponent implements OnInit {
  private HOST: string = 'http://localhost:8000/';

  formShowed: boolean = false;
  response: any;
  genres: any;

  duration: string = '';
  rating: string = '';
  genre: string = '';
  description: string = '';

  private MAXDURATION: number = 10000;
  private MAXRATING: number = 10;
  private ducationValid: boolean = false;
  private ratingValid: boolean = false;
  private genreValid: boolean = false;
  private descriptionValid: boolean = false;

  constructor(private http: HttpClient) { }

  ngOnInit() {
    this.getGenres();
  }

  showTheForm () {
    this.formShowed = !this.formShowed;
  }

  getGenres () {
    this.http.get(this.HOST + 'genres')
    .subscribe((response) => {
      this.genres = response;
      // console.log(this.genres);
    })
  }

  durationValidate () {
    if (Number(this.duration) > 0 && Number(this.duration) < this.MAXDURATION) {
      this.ducationValid = true;
    } else {
      this.ducationValid = false;
    }
  }

  ratingValidate () {
    if (Number(this.rating) > 0 && Number(this.rating) < this.MAXRATING + 1) {
      this.ratingValid = true;
    } else {
      this.ratingValid = false;
    }
  }

  genreValidate () {
    if (Number(this.genre) >= 0 && Number(this.genre) < this.genres.length) {
      this.genreValid = true;
    } else {
      this.genreValid = false;
    }
  }

  descriptionValidate () {
    if (this.description.length > 3) {
      this.descriptionValid = true;
    } else {
      this.descriptionValid = false;
    }
  }

  formValidate () {
    if (this.ducationValid && this.ratingValid && this.genreValid && this.descriptionValid) {
      return true;
    }

    return false;
  }

  store () {
    let data = {
      "duration":this.duration,
      "rating":this.rating,
      "genre":this.genre,
      "description":this.description,
    };
    this.http.post(this.HOST + 'store', data)
    .subscribe((response) => {
      this.response = response;
      console.log(this.response);
      this.resetForm();
    })
  }

  resetForm () {
    setTimeout(() => {
      this.response = false;

      this.duration = '';
      this.rating = '';
      this.genre = '';
      this.description = '';

      this.ducationValid = false;
      this.ratingValid = false;
      this.genreValid = false;
      this.descriptionValid = false;

      this.formShowed = false;
    }, 350);
  }
}
