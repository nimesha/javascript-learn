const person = {
  firstName: 'Nimesha',
  lastName: 'gunawardana',
  age: 35,
};

const { firstName, lastName } = person;

console.log(firstName, lastName);

/** number  */

const numbers = [30, 56, 68];

const [a, b] = numbers;

console.log(a, b);

/** function return object  */

const getCalculations = (x, y) => {
  return {
    sum: x + y,
    diff: Math.abs(x - y),
    product: x * y,
  };
};
/** name is important */
const { sum, product, diff } = getCalculations(3, 5);

console.log(sum, product, diff);

/** function return array  */

const getCalculationsArray = (x, y) => {
  return [x + y, Math.abs(x - y), x * y];
};
/** order is important */
const [sumA, diffA, productA] = getCalculationsArray(3, 5);

console.log(sumA, diffA, productA);
