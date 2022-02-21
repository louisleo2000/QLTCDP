import { TestBed } from '@angular/core/testing';

import { AlertAndLoadingService } from './alert-and-loading.service';

describe('AlertAndLoadingService', () => {
  let service: AlertAndLoadingService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AlertAndLoadingService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
