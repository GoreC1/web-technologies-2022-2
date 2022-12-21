const students = [
    { name: 'Павел', age: 20 },
    { name: 'Иван', age: 20 },
    { name: 'Эдем', age: 20 },
    { name: 'Денис', age: 20 },
    { name: 'Виктория', age: 20 },
    { age: 40 }]

const pickPropArray = (array, prop) => 
  array.reduce((arr,item)=>
  {
    if(item.hasOwnProperty(prop)) 
    {
      arr.push(item[prop]);
    }
    
    return arr;
  }, []);

console.log(pickPropArray(students, 'name'));

const createCounter = () => 
{
  let i = 0;
 
  return function()
  {
    console.log(++i);
  };
}

const counter1 = createCounter();
counter1();
counter1();

const counter2 = createCounter();
counter2();
counter2();

const spinWords = (str) => 
{
  const matches = str
    .match(/[А-Яа-яA-Za-z]+/ig)
    .map(word=>!(word.length < 5) ? word.split('').reverse().join('') : word);
  
    return matches.join(' ');
}

console.log(spinWords('Привет из Legacy'));
console.log(spinWords('This is a test'));

const getSum = (nums, target) => 
{
  for(let i=0;i<nums.length; i++)
    for(let j=i; j<nums.length; j++)
      if(nums[i]+nums[j]===target && i!==j)
        return([i,j]);
};

console.log(getSum([2,7,11,15],9));

const longestStringPref = (words) => 
{ 
  if(words.length < 2) return;
    const reversedWords = words.map(word=>word.split('').reverse().join(''));
    const smallestWordLength = Math.min(...words.map(word=>word.length));

  const result = [];
  
  for (let i=0; i<smallestWordLength; i++)
  {
    let symbol = reversedWords[0][i];
    
    if (reversedWords.every(word=>word[i]===symbol))
      result.push(symbol);
  }
  
  return result.length < 2 ? '' : result.reverse().join('');
}

console.log(longestStringPref(['цветок', 'поток', 'хлопок']));
console.log(longestStringPref(["собака","гоночная машина","машина"]));