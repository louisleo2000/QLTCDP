import { TestBed } from '@angular/core/testing';

import { StackGuard } from './stack.guard';

describe('StackGuard', () => {
  let guard: StackGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(StackGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
