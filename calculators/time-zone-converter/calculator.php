<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class TimeZoneConverter {
    private $timeZones = [
        'Pacific/Midway' => 'UTC-11:00',
        'Pacific/Honolulu' => 'UTC-10:00',
        'America/Anchorage' => 'UTC-09:00',
        'America/Los_Angeles' => 'UTC-08:00',
        'America/Denver' => 'UTC-07:00',
        'America/Chicago' => 'UTC-06:00',
        'America/New_York' => 'UTC-05:00',
        'America/Halifax' => 'UTC-04:00',
        'America/St_Johns' => 'UTC-03:30',
        'America/Sao_Paulo' => 'UTC-03:00',
        'UTC' => 'UTC+00:00',
        'Europe/London' => 'UTC+00:00',
        'Europe/Paris' => 'UTC+01:00',
        'Europe/Athens' => 'UTC+02:00',
        'Europe/Moscow' => 'UTC+03:00',
        'Asia/Dubai' => 'UTC+04:00',
        'Asia/Karachi' => 'UTC+05:00',
        'Asia/Dhaka' => 'UTC+06:00',
        'Asia/Bangkok' => 'UTC+07:00',
        'Asia/Shanghai' => 'UTC+08:00',
        'Asia/Tokyo' => 'UTC+09:00',
        'Australia/Sydney' => 'UTC+10:00',
        'Pacific/Noumea' => 'UTC+11:00',
        'Pacific/Auckland' => 'UTC+12:00'
    ];

    public function convertTime($fromZone, $toZone, $date, $time, $timestamp = null) {
        try {
            if ($timestamp) {
                $dateTime = new DateTime('@' . $timestamp);
            } else {
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time);
            }

            if (!$dateTime) {
                throw new Exception('Invalid date/time format');
            }

            // Set source timezone
            $fromTZ = new DateTimeZone($fromZone);
            $dateTime->setTimezone($fromTZ);

            // Convert to target timezone
            $toTZ = new DateTimeZone($toZone);
            $convertedTime = clone $dateTime;
            $convertedTime->setTimezone($toTZ);

            // Get timezone information
            $fromOffset = $fromTZ->getOffset($dateTime);
            $toOffset = $toTZ->getOffset($convertedTime);
            $offsetDifference = $toOffset - $fromOffset;

            return [
                'success' => true,
                'original' => [
                    'timezone' => $fromZone,
                    'datetime' => $dateTime->format('Y-m-d H:i:s'),
                    'formatted' => $dateTime->format('D, M j, Y g:i A'),
                    'offset' => $this->formatOffset($fromOffset)
                ],
                'converted' => [
                    'timezone' => $toZone,
                    'datetime' => $convertedTime->format('Y-m-d H:i:s'),
                    'formatted' => $convertedTime->format('D, M j, Y g:i A'),
                    'offset' => $this->formatOffset($toOffset)
                ],
                'difference' => [
                    'hours' => $offsetDifference / 3600,
                    'formatted' => $this->formatOffset($offsetDifference)
                ],
                'timestamp' => $dateTime->getTimestamp()
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getTimeDifference($zone1, $zone2) {
        try {
            $now = new DateTime('now', new DateTimeZone($zone1));
            $zone2Time = clone $now;
            $zone2Time->setTimezone(new DateTimeZone($zone2));

            $offset1 = $now->getTimezone()->getOffset($now);
            $offset2 = $zone2Time->getTimezone()->getOffset($zone2Time);
            $difference = $offset2 - $offset1;

            return [
                'success' => true,
                'zone1' => [
                    'name' => $zone1,
                    'current_time' => $now->format('D, M j, Y g:i A'),
                    'offset' => $this->formatOffset($offset1)
                ],
                'zone2' => [
                    'name' => $zone2,
                    'current_time' => $zone2Time->format('D, M j, Y g:i A'),
                    'offset' => $this->formatOffset($offset2)
                ],
                'difference' => [
                    'hours' => $difference / 3600,
                    'formatted' => $this->formatOffset($difference),
                    'ahead' => $difference > 0
                ]
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function calculateArrivalTime($departureZone, $arrivalZone, $departureTime, $flightDuration) {
        try {
            // Parse departure time
            $departure = DateTime::createFromFormat('Y-m-d\TH:i', $departureTime);
            if (!$departure) {
                throw new Exception('Invalid departure time format');
            }

            // Set departure timezone
            $departureTZ = new DateTimeZone($departureZone);
            $departure->setTimezone($departureTZ);

            // Parse flight duration
            if (!preg_match('/^(\d+):(\d+)$/', $flightDuration, $matches)) {
                throw new Exception('Invalid flight duration format. Use HH:MM');
            }

            $hours = intval($matches[1]);
            $minutes = intval($matches[2]);
            $durationMinutes = $hours * 60 + $minutes;

            // Calculate arrival time
            $arrival = clone $departure;
            $arrival->modify("+{$durationMinutes} minutes");

            // Convert to arrival timezone
            $arrivalTZ = new DateTimeZone($arrivalZone);
            $arrival->setTimezone($arrivalTZ);

            // Calculate total travel time considering time zones
            $travelTime = $arrival->getTimestamp() - $departure->getTimestamp();

            return [
                'success' => true,
                'departure' => [
                    'timezone' => $departureZone,
                    'datetime' => $departure->format('D, M j, Y g:i A'),
                    'local' => $departure->format('g:i A')
                ],
                'arrival' => [
                    'timezone' => $arrivalZone,
                    'datetime' => $arrival->format('D, M j, Y g:i A'),
                    'local' => $arrival->format('g:i A')
                ],
                'flight' => [
                    'duration' => $flightDuration,
                    'total_travel' => $this->formatDuration($travelTime)
                ],
                'timezone_change' => [
                    'from_offset' => $this->formatOffset($departureTZ->getOffset($departure)),
                    'to_offset' => $this->formatOffset($arrivalTZ->getOffset($arrival))
                ]
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function planMeeting($meetingTime, $duration, $participants) {
        try {
            $meetingStart = new DateTime($meetingTime);
            $meetingEnd = clone $meetingStart;
            $meetingEnd->modify("+{$duration} minutes");

            $participantTimes = [];

            foreach ($participants as $participant) {
                $participantTZ = new DateTimeZone($participant['timezone']);
                $participantStart = clone $meetingStart;
                $participantStart->setTimezone($participantTZ);
                $participantEnd = clone $meetingEnd;
                $participantEnd->setTimezone($participantTZ);

                // Check if within working hours
                $inWorkingHours = true;
                if (!empty($participant['working_hours'])) {
                    $startHour = intval(substr($participant['working_hours']['start'], 0, 2));
                    $endHour = intval(substr($participant['working_hours']['end'], 0, 2));
                    $meetingHour = intval($participantStart->format('H'));

                    $inWorkingHours = $meetingHour >= $startHour && $meetingHour < $endHour;
                }

                $participantTimes[] = [
                    'name' => $participant['name'],
                    'timezone' => $participant['timezone'],
                    'local_time' => $participantStart->format('D, M j, g:i A'),
                    'end_time' => $participantEnd->format('g:i A'),
                    'in_working_hours' => $inWorkingHours,
                    'offset' => $this->formatOffset($participantTZ->getOffset($participantStart))
                ];
            }

            return [
                'success' => true,
                'meeting' => [
                    'start' => $meetingStart->format('D, M j, Y g:i A'),
                    'end' => $meetingEnd->format('g:i A'),
                    'duration' => $duration . ' minutes'
                ],
                'participants' => $participantTimes
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getWorldClocks($timezones) {
        $clocks = [];
        $now = new DateTime();

        foreach ($timezones as $timezone) {
            try {
                $tz = new DateTimeZone($timezone);
                $clockTime = clone $now;
                $clockTime->setTimezone($tz);

                $clocks[] = [
                    'timezone' => $timezone,
                    'time' => $clockTime->format('g:i A'),
                    'date' => $clockTime->format('D, M j'),
                    'offset' => $this->formatOffset($tz->getOffset($clockTime)),
                    'is_dst' => $tz->getTransitions($now->getTimestamp(), $now->getTimestamp())[0]['isdst']
                ];
            } catch (Exception $e) {
                // Skip invalid timezone
                continue;
            }
        }

        return $clocks;
    }

    public function getTimezoneInfo($timezone) {
        try {
            $tz = new DateTimeZone($timezone);
            $now = new DateTime('now', $tz);
            $transitions = $tz->getTransitions($now->getTimestamp(), $now->getTimestamp() + 365 * 24 * 3600);

            $current = $transitions[0];
            $nextTransition = count($transitions) > 1 ? $transitions[1] : null;

            $info = [
                'name' => $timezone,
                'current_offset' => $this->formatOffset($current['offset']),
                'is_dst' => $current['isdst'],
                'current_time' => $now->format('D, M j, Y g:i A'),
                'location' => $this->getTimezoneLocation($timezone)
            ];

            if ($nextTransition) {
                $info['next_transition'] = [
                    'timestamp' => $nextTransition['ts'],
                    'time' => date('D, M j, Y g:i A', $nextTransition['ts']),
                    'offset' => $this->formatOffset($nextTransition['offset']),
                    'is_dst' => $nextTransition['isdst']
                ];
            }

            return [
                'success' => true,
                'info' => $info
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function formatOffset($offset) {
        $hours = $offset / 3600;
        $formatted = sprintf('%+03d:%02d', floor($hours), abs(($hours - floor($hours)) * 60));
        return $formatted;
    }

    private function formatDuration($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        return sprintf('%dh %dm', $hours, $minutes);
    }

    private function getTimezoneLocation($timezone) {
        $locations = [
            'America/New_York' => 'Eastern Time (US & Canada)',
            'America/Chicago' => 'Central Time (US & Canada)',
            'America/Denver' => 'Mountain Time (US & Canada)',
            'America/Los_Angeles' => 'Pacific Time (US & Canada)',
            'Europe/London' => 'London, United Kingdom',
            'Europe/Paris' => 'Paris, France',
            'Europe/Berlin' => 'Berlin, Germany',
            'Asia/Tokyo' => 'Tokyo, Japan',
            'Asia/Shanghai' => 'Shanghai, China',
            'Australia/Sydney' => 'Sydney, Australia'
        ];

        return $locations[$timezone] ?? $timezone;
    }

    public function getAllTimezones() {
        return $this->timeZones;
    }
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    $converter = new TimeZoneConverter();
    $response = [];
    
    switch ($action) {
        case 'convert':
            $fromZone = $input['fromZone'] ?? '';
            $toZone = $input['toZone'] ?? '';
            $date = $input['date'] ?? '';
            $time = $input['time'] ?? '';
            $timestamp = $input['timestamp'] ?? null;
            
            $result = $converter->convertTime($fromZone, $toZone, $date, $time, $timestamp);
            $response = $result;
            break;
            
        case 'time_difference':
            $zone1 = $input['zone1'] ?? '';
            $zone2 = $input['zone2'] ?? '';
            
            $result = $converter->getTimeDifference($zone1, $zone2);
            $response = $result;
            break;
            
        case 'calculate_arrival':
            $departureZone = $input['departureZone'] ?? '';
            $arrivalZone = $input['arrivalZone'] ?? '';
            $departureTime = $input['departureTime'] ?? '';
            $flightDuration = $input['flightDuration'] ?? '';
            
            $result = $converter->calculateArrivalTime($departureZone, $arrivalZone, $departureTime, $flightDuration);
            $response = $result;
            break;
            
        case 'plan_meeting':
            $meetingTime = $input['meetingTime'] ?? '';
            $duration = $input['duration'] ?? 60;
            $participants = $input['participants'] ?? [];
            
            $result = $converter->planMeeting($meetingTime, $duration, $participants);
            $response = $result;
            break;
            
        case 'get_world_clocks':
            $timezones = $input['timezones'] ?? [];
            $result = $converter->getWorldClocks($timezones);
            $response = ['success' => true, 'clocks' => $result];
            break;
            
        case 'get_timezone_info':
            $timezone = $input['timezone'] ?? '';
            $result = $converter->getTimezoneInfo($timezone);
            $response = $result;
            break;
            
        case 'get_all_timezones':
            $timezones = $converter->getAllTimezones();
            $response = ['success' => true, 'timezones' => $timezones];
            break;
            
        default:
            $response = ['success' => false, 'error' => 'Unknown action'];
    }
    
    echo json_encode($response);
    exit;
}
?>