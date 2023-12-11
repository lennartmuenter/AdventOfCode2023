import collections

file = open('7.txt').read().split('\n')

def getKind(hand):
    duplicates = {i:hand.count(i) for i in hand}
    numbers = sorted(duplicates.values(), reverse=True)
    return [[1,1,1,1,1], [2,1,1,1], [2,2,1], [3,1,1], [3,2], [4,1], [5,]].index(numbers)

def rankHand(hand, part):
    indexedHand = ['X23456789TJQKA'.index(i) for i in hand]
    if part == 2:
        kinds = []
        indexedHand = ['J23456789TXQKA'.index(i) for i in hand]
        for replacement in '23456789TQKA':
            kinds.append(getKind(hand.replace('J', replacement)))
        kind = max(kinds)
    else: 
        kind = getKind(hand)
    indexedHand.insert(0, kind)
    return indexedHand

def calcTotal(hands):
    totalWin = 0
    hands = sorted(hands)
    for i, hand in enumerate(hands):
        bet = hand[1]
        totalWin += (i+1) * int(bet)
    return(totalWin)

handsFirst = []
handsSecond = []

for line in file:
    hand, bet = line.split()
    handFirst = (rankHand(hand, 1))
    handSecond = (rankHand(hand, 2))
    handsFirst.append((handFirst,bet))
    handsSecond.append((handSecond,bet))
      
print(calcTotal(handsFirst))
print(calcTotal(handsSecond))