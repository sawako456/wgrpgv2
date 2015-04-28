<?php namespace Cryptic\Wgrpg\Support\Time;

use DateTime;
use DateTimeZone;
use Illuminate\Contracts\Config\Repository as Config;
use Carbon\Carbon;
use Auth;
use Cryptic\Wgrpg\Contracts\Entities\User as UserEntityContract;

class TimeZone
{
    /**
     * @var string
     */
    const DEFAULT_TIME_ZONE = 'UTC';

    /**
     * @var string
     */
    protected $appTimeZone;

    /**
     * Construct a new instance of the time zone helper.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     *
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->appTimeZone = new DateTimeZone($config->get('app.timezone'));
    }

    /**
     * Convert a given date from one time zone to another.
     *
     * @param mixed $date
     * @param mixed $from
     * @param mixed $to
     *
     * @return \DateTime
     */
    public function convert($date, $from = null, $to = null)
    {
        if (!$date instanceof DateTime) {
            if (!empty($date) && is_string($date)) {
                $date = Carbon::parse($date);
            } else {
                $date = Carbon::now();
            }
        }

        if (!empty($from) && is_string($from)) {
            $from = new DateTimeZone($from);
        } elseif (!$from instanceof DateTimeZone) {
            $from = new DateTimeZone(self::DEFAULT_TIME_ZONE);
        }

        if (!empty($to) && is_string($to)) {
            $to = new DateTimeZone($to);
        } elseif (!$to instanceof DateTimeZone) {
            $to = new DateTimeZone(self::DEFAULT_TIME_ZONE);
        }

        return (new Carbon($date, $from))->setTimezone($to);
    }

    /**
     * Convert the given date from the app time zone to the local one.
     *
     * @param mixed $date
     *
     * @return \DateTime
     */
    public function appToLocal($date)
    {
        if (is_null($date)) {
            $date = Carbon::now();
        }

        return $this->convert($date, $this->appTimeZone, $this->getLocalTimeZone());
    }

    /**
     * Convert the given date from the local time zone to the app one.
     *
     * @param mixed $date
     *
     * @return \DateTime
     */
    public function localToApp($date)
    {
        if (is_null($date)) {
            $date = Carbon::now();
        }

        return $this->convert($date, $this->getLocalTimeZone(), $this->appTimeZone);
    }

    /**
     * Get the local time zone (somehow).
     *
     * @param \Cryptic\Wgrpg\Contracts\Entities\User $user
     *
     * @return string
     */
    public function getLocalTimeZone(UserEntityContract $user = null)
    {
        if ($user) {
            return $user->time_zone;
        } else {
            return Auth::user()->time_zone;
        }
    }
}