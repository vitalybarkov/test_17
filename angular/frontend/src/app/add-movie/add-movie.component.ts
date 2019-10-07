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
  private durationValid: boolean = false;
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
    })
  }

  durationValidate () {
    let duration = Number((this.duration));
    if (!(this.duration.indexOf('.') > -1) && Number.isInteger(duration) && duration > 0 && duration < this.MAXDURATION) {
      this.durationValid = true;
    } else {
      this.durationValid = false;
    }
  }

  ratingValidate () {
    let rating = Number((this.rating));
    if (!(this.rating.indexOf('.') > -1) && Number.isInteger(rating) && rating > 0 && rating < this.MAXRATING + 1) {
      this.ratingValid = true;
    } else {
      this.ratingValid = false;
    }
  }

  genreValidate () {
    let genre = Number((this.genre));
    if (!(this.genre.indexOf('.') > -1) && Number.isInteger(genre) && genre >= 0 && genre < this.genres.length) {
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
    if (this.durationValid && this.ratingValid && this.genreValid && this.descriptionValid) {
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

      this.durationValid = false;
      this.ratingValid = false;
      this.genreValid = false;
      this.descriptionValid = false;

      this.formShowed = false;
    }, 350);
  }
}
