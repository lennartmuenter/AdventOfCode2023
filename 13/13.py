patterns = list(map(str.split, open('13.txt').read().split('\n\n')))

def findDifference(pattern, index):
    amount = 0
    for line in pattern:
        for a,b in zip(line[index:], line[index - 1 :: -1]):
            if a != b: amount += 1
            
    return amount

def getPreAmount(pattern, part):
    amount = 0
    for col in range(1, len(pattern[0])):
        if findDifference(pattern, col) == part:
            amount += col
    return amount
        
count = {
    1: 0,
    2: 0,
}

for pattern in patterns:
    for part in (0,1):
        count[part + 1] += getPreAmount(pattern, part) + 100 * getPreAmount([*zip(*pattern)], part)

print(count)