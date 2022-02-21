import { TestBed } from '@angular/core/testing';

import { ChildDetailsGuard } from './child-details.guard';

describe('ChildDetailsGuard', () => {
  let guard: ChildDetailsGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(ChildDetailsGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
