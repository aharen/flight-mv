# Flight MV

Velaanaa International Airport arrivals/departures from fis.com.mv

## Installation

```
composer require aharen/flight-mv
```

## Usage

Fetch Arrivals

```
use aharen\FlightMv\Flight;

(new Flight)->arrivals()->get();
```

Fetch Departures

```
use aharen\FlightMv\Flight;

(new Flight)->departures()->get();
```

## Methods

`updated()` Last updated time

```
use aharen\FlightMv\Flight;

(new Flight)->departures()->updated();
```

`get()` returns an instance of Knapsack Collection

```
use aharen\FlightMv\Flight;

(new Flight)->departures()->get();
```

`toArray()` return an array of the data

```
use aharen\FlightMv\Flight;

(new Flight)->departures()->toArray();
```

`where($field, $value)` Filters the data

```
use aharen\FlightMv\Flight;

(new Flight)->departures()->where('AirLineID', 'Q2');
```

You can also nest to further filter your results. Example: get all Q2 (Maldivian) but only International Flights

```
use aharen\FlightMv\Flight;

(new Flight)->departures()->where('AirLineID', 'Q2')
    ->where('CarrierType', 'I');
```

You will need to call either `toArray()` or `get()` to get the filtered results.
